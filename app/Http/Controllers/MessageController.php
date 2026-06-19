<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Get chat history with a specific friend.
     */
    public function getChatHistory($friendId)
    {
        $user = Auth::user();

        // Verify friendship exists and is accepted
        $isFriend = Friendship::where(function($q) use ($user, $friendId) {
            $q->where('user_id', $user->id)->where('friend_id', $friendId);
        })->orWhere(function($q) use ($user, $friendId) {
            $q->where('user_id', $friendId)->where('friend_id', $user->id);
        })->where('status', 'accepted')->exists();

        if (!$isFriend) {
            return response()->json(['success' => false, 'message' => 'Anda belum berteman dengan pengguna ini.'], 403);
        }

        // Fetch messages between current user and friend
        $messages = Message::where(function($q) use ($user, $friendId) {
            $q->where('sender_id', $user->id)->where('receiver_id', $friendId);
        })->orWhere(function($q) use ($user, $friendId) {
            $q->where('sender_id', $friendId)->where('receiver_id', $user->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // Mark incoming messages from this friend as read
        Message::where('sender_id', $friendId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $formattedMessages = $messages->map(fn($m) => [
            'id' => $m->id,
            'sender_id' => $m->sender_id,
            'receiver_id' => $m->receiver_id,
            'message' => $m->message,
            'time' => $m->created_at->format('H:i'),
        ]);

        return response()->json([
            'success' => true,
            'messages' => $formattedMessages,
        ]);
    }

    /**
     * Send a new message to a specific friend.
     */
    public function sendMessage(Request $request, $friendId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Verify friendship
        $isFriend = Friendship::where(function($q) use ($user, $friendId) {
            $q->where('user_id', $user->id)->where('friend_id', $friendId);
        })->orWhere(function($q) use ($user, $friendId) {
            $q->where('user_id', $friendId)->where('friend_id', $user->id);
        })->where('status', 'accepted')->exists();

        if (!$isFriend) {
            return response()->json(['success' => false, 'message' => 'Anda belum berteman dengan pengguna ini.'], 403);
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $friendId,
            'message' => $request->input('message'),
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'sender_id' => $message->sender_id,
                'receiver_id' => $message->receiver_id,
                'message' => $message->message,
                'time' => $message->created_at->format('H:i'),
            ],
        ]);
    }

    /**
     * Fetch real-time polling updates: unread message counts, total notifications, and incoming chat messages.
     */
    public function getUpdates(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Get unread counts grouped by sender
        $unreadGroups = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->selectRaw('sender_id, COUNT(*) as count')
            ->groupBy('sender_id')
            ->get();

        $unreadTotal = $unreadGroups->sum('count');
        
        $activeChats = [];
        foreach ($unreadGroups as $group) {
            $activeChats[$group->sender_id] = $group->count;
        }

        // Check if there are new messages from the currently active friend in the user's browser
        $activeFriendId = $request->query('active_friend_id');
        $newMessages = [];

        if ($activeFriendId) {
            $incoming = Message::where('sender_id', $activeFriendId)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->orderBy('created_at', 'asc')
                ->get();

            if ($incoming->isNotEmpty()) {
                // Mark them as read immediately since the user has this chat open
                Message::where('sender_id', $activeFriendId)
                    ->where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

                $newMessages = $incoming->map(fn($m) => [
                    'id' => $m->id,
                    'sender_id' => $m->sender_id,
                    'receiver_id' => $m->receiver_id,
                    'message' => $m->message,
                    'time' => $m->created_at->format('H:i'),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'unread_total' => $unreadTotal,
            'active_chats' => $activeChats,
            'new_messages' => $newMessages,
        ]);
    }
}

