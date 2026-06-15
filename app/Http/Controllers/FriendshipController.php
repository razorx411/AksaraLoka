<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    /**
     * Get accepted friends and pending requests.
     */
    public function listFriends()
    {
        $user = Auth::user();

        // Accepted Friends
        $friends = $user->friends()->map(fn($f) => [
            'id' => $f->id,
            'username' => $f->username,
            'avatar_url' => $f->avatar_url,
            'streak' => $f->streak_count,
            'points' => $f->total_points,
            'level' => $f->getUserLevel(),
        ]);

        // Pending Received Requests
        $pending = $user->pendingFriendRequests()->map(fn($p) => [
            'id' => $p->id,
            'username' => $p->username,
            'avatar_url' => $p->avatar_url,
        ]);

        return response()->json([
            'success' => true,
            'friends' => $friends,
            'pending' => $pending,
        ]);
    }

    /**
     * Search other users and check relationship status.
     */
    public function searchUsers(Request $request)
    {
        $query = $request->get('q');
        if (empty($query)) {
            return response()->json(['success' => true, 'users' => []]);
        }

        $currentUser = Auth::user();

        // Search users excluding the current user
        $users = User::where('id', '!=', $currentUser->id)
            ->where('role', 'user')
            ->where(function($q) use ($query) {
                $q->where('username', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->take(10)
            ->get();

        // Fetch relationships for these users to determine status
        $userIds = $users->pluck('id')->toArray();
        
        $friendships = Friendship::where(function($q) use ($currentUser, $userIds) {
            $q->where('user_id', $currentUser->id)->whereIn('friend_id', $userIds);
        })->orWhere(function($q) use ($currentUser, $userIds) {
            $q->where('friend_id', $currentUser->id)->whereIn('user_id', $userIds);
        })->get();

        $formattedUsers = $users->map(function($u) use ($currentUser, $friendships) {
            // Find if there is an existing friendship
            $fs = $friendships->first(fn($item) => 
                ($item->user_id == $currentUser->id && $item->friend_id == $u->id) ||
                ($item->friend_id == $currentUser->id && $item->user_id == $u->id)
            );

            $status = 'none';
            if ($fs) {
                if ($fs->status === 'accepted') {
                    $status = 'accepted';
                } else {
                    $status = ($fs->user_id == $currentUser->id) ? 'pending_sent' : 'pending_received';
                }
            }

            return [
                'id' => $u->id,
                'username' => $u->username,
                'avatar_url' => $u->avatar_url,
                'status' => $status,
            ];
        });

        return response()->json([
            'success' => true,
            'users' => $formattedUsers,
        ]);
    }

    /**
     * Send a friend request.
     */
    public function sendRequest(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);
        
        $user = Auth::user();
        $friendId = $request->input('friend_id');

        if ($user->id == $friendId) {
            return response()->json(['success' => false, 'message' => 'Anda tidak bisa berteman dengan diri sendiri.'], 422);
        }

        // Check if relationship already exists
        $existing = Friendship::where(function($q) use ($user, $friendId) {
            $q->where('user_id', $user->id)->where('friend_id', $friendId);
        })->orWhere(function($q) use ($user, $friendId) {
            $q->where('user_id', $friendId)->where('friend_id', $user->id);
        })->first();

        if ($existing) {
            if ($existing->status === 'accepted') {
                return response()->json(['success' => false, 'message' => 'Anda sudah berteman dengan pengguna ini.']);
            }
            return response()->json(['success' => false, 'message' => 'Permintaan pertemanan sudah dikirim atau sedang tertunda.']);
        }

        Friendship::create([
            'user_id' => $user->id,
            'friend_id' => $friendId,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Permintaan pertemanan berhasil dikirim.']);
    }

    /**
     * Accept a friend request.
     */
    public function acceptRequest(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);
        
        $user = Auth::user();
        $friendId = $request->input('friend_id');

        $friendship = Friendship::where('user_id', $friendId)
            ->where('friend_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$friendship) {
            return response()->json(['success' => false, 'message' => 'Permintaan pertemanan tidak ditemukan.'], 404);
        }

        $friendship->status = 'accepted';
        $friendship->save();

        return response()->json(['success' => true, 'message' => 'Permintaan pertemanan diterima. Sekarang Anda berteman!']);
    }

    /**
     * Decline a friend request or remove an existing friend.
     */
    public function declineRequest(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);
        
        $user = Auth::user();
        $friendId = $request->input('friend_id');

        $friendship = Friendship::where(function($q) use ($user, $friendId) {
            $q->where('user_id', $user->id)->where('friend_id', $friendId);
        })->orWhere(function($q) use ($user, $friendId) {
            $q->where('user_id', $friendId)->where('friend_id', $user->id);
        })->first();

        if (!$friendship) {
            return response()->json(['success' => false, 'message' => 'Hubungan pertemanan tidak ditemukan.'], 404);
        }

        $friendship->delete();

        return response()->json(['success' => true, 'message' => 'Pertemanan atau permintaan pertemanan berhasil dibatalkan.']);
    }

    /**
     * Get user profile details for preview card (flex stats & achievements).
     */
    public function friendProfilePreview($id)
    {
        $currentUser = Auth::user();
        $targetUser = User::find($id);

        if (!$targetUser) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        // Fetch achievements (similar logic to ProfilController)
        $allAchievements = Achievement::orderBy('id')->get();
        $earned = $targetUser->achievements()->withPivot('earned_at')->get()->keyBy('id');

        $achievements = $allAchievements->map(function ($a) use ($earned) {
            $isEarned = $earned->has($a->id);
            return [
                'name'        => $a->name,
                'description' => $a->description,
                'icon'        => $a->icon,
                'color'       => $a->color,
                'earned'      => $isEarned,
                'date'        => $isEarned
                    ? \Illuminate\Support\Carbon::parse($earned[$a->id]->pivot->earned_at)->format('d/m/Y')
                    : null,
            ];
        });

        // Let's determine relationship status between current user and target user
        $fs = Friendship::where(function($q) use ($currentUser, $id) {
            $q->where('user_id', $currentUser->id)->where('friend_id', $id);
        })->orWhere(function($q) use ($currentUser, $id) {
            $q->where('friend_id', $currentUser->id)->where('user_id', $id);
        })->first();

        $status = 'none';
        if ($fs) {
            if ($fs->status === 'accepted') {
                $status = 'accepted';
            } else {
                $status = ($fs->user_id == $currentUser->id) ? 'pending_sent' : 'pending_received';
            }
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $targetUser->id,
                'username' => $targetUser->username,
                'avatar_url' => $targetUser->avatar_url,
                'bio' => $targetUser->bio ?? 'Melestarikan keanggunan Hanacaraka melalui latihan harian.',
                'level' => $targetUser->getUserLevel(),
                'xp' => $targetUser->total_points,
                'streak' => $targetUser->streak_count,
                'joined_at' => $targetUser->created_at->format('M Y'),
                'relationship' => $status
            ],
            'achievements' => $achievements
        ]);
    }
}
