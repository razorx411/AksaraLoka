<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Chapter;
use App\Models\UserLevelProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // ── Achievements ─────────────────────────────────────────────
        $allAchievements = Achievement::orderBy('id')->get();
        $earned          = $user->achievements()->withPivot('earned_at')->get()
            ->keyBy('id');

        $achievements = $allAchievements->map(function ($a) use ($earned) {
            $isEarned = $earned->has($a->id);
            return [
                'name'        => $a->name,
                'description' => $a->description,
                'icon'        => $a->icon,
                'color'       => $a->color,
                'earned'      => $isEarned,
                'date'        => $isEarned
                    ? $earned[$a->id]->pivot->earned_at->format('d/m/y')
                    : 'Terkunci',
            ];
        });

        // ── Skill Progress (per chapter, up to 4) ────────────────────
        $skillDefs = [
            ['name' => 'Membaca',   'icon' => 'menu_book'],
            ['name' => 'Menulis',   'icon' => 'edit_note'],
            ['name' => 'Berbicara', 'icon' => 'record_voice_over'],
            ['name' => 'Budaya',    'icon' => 'temple_buddhist'],
        ];

        $chapters       = Chapter::with(['subChapters.levels'])
            ->orderBy('order_index')->take(4)->get();
        $completedIds   = UserLevelProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->pluck('level_id')
            ->toArray();

        $skills = [];
        foreach ($skillDefs as $i => $def) {
            $chapter = $chapters->get($i);
            if ($chapter) {
                $total = 0;
                $done  = 0;
                foreach ($chapter->subChapters as $sub) {
                    foreach ($sub->levels as $lvl) {
                        $total++;
                        if (in_array($lvl->id, $completedIds)) {
                            $done++;
                        }
                    }
                }
                $pct = $total > 0 ? round(($done / $total) * 100) : 0;
            } else {
                $pct = 0;
            }
            $skills[] = array_merge($def, ['progress' => $pct]);
        }

        return view('pages.profil', compact('achievements', 'skills'));
    }

    public function edit()
    {
        return view('pages.profiledit');
    }

    // ── API: get current user data ────────────────────────────────────

    public function apiGet()
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Belum login'], 401);
        }
        return response()->json([
            'success' => true,
            'user'    => [
                'id'         => $user->id,
                'username'   => $user->username,
                'email'      => $user->email,
                'bio'        => $user->bio,
                'avatar_url' => $user->avatar_url,
            ],
        ]);
    }

    // ── Update profile (text fields) ──────────────────────────────────

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'bio'      => 'nullable|max:500',
        ], [
            'username.required' => 'Nama pengguna wajib diisi (maks. 100 karakter).',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah digunakan akun lain.',
            'password.min'      => 'Kata sandi minimal 8 karakter.',
            'bio.max'           => 'Bio maksimal 500 karakter.',
        ]);

        $user->username = $request->username;
        $user->email    = $request->email;
        $user->bio      = $request->bio;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
            'user'    => ['username' => $user->username, 'email' => $user->email],
        ]);
    }

    // ── Upload avatar ─────────────────────────────────────────────────

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'avatar.required' => 'File foto wajib dipilih.',
            'avatar.image'    => 'File harus berupa gambar.',
            'avatar.mimes'    => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'avatar.max'      => 'Ukuran foto maksimal 2 MB.',
        ]);

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Store new avatar under storage/app/public/avatars/
        $path = $request->file('avatar')->store('avatars', 'public');

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Foto profil berhasil diperbarui.',
            'avatar_url' => $user->avatar_url,
        ]);
    }

    // ── Delete account ────────────────────────────────────────────────

    public function destroy(Request $request)
    {
        $user     = Auth::user();
        $password = $request->input('password', '');

        if ($password === '') {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi wajib diisi untuk konfirmasi.',
            ], 422);
        }

        if (! Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi salah. Akun tidak dihapus.',
            ], 401);
        }

        // Delete avatar from storage
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true, 'message' => 'Akun berhasil dihapus.']);
    }
}
