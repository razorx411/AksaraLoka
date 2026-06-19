<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status', 'all'); // all | active | inactive

        $query = User::withTrashed()
            ->where('role', 'user')
            ->when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            }))
            ->when($status === 'active',   fn($q) => $q->whereNull('deleted_at'))
            ->when($status === 'inactive', fn($q) => $q->whereNotNull('deleted_at'))
            ->withCount('levelProgress')
            ->orderByDesc('created_at');

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'search', 'status'));
    }

    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->load(['levelProgress.level.subChapter.chapter']);
        $completedLevels = $user->levelProgress->where('is_completed', true)->count();
        $totalLevels     = \App\Models\Level::count();
        return view('admin.users.show', compact('user', 'completedLevels', 'totalLevels'));
    }

    public function toggleStatus($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
            $msg = "Akun {$user->username} berhasil dipulihkan.";
        } else {
            $user->delete();
            $msg = "Akun {$user->username} berhasil dinonaktifkan.";
        }

        return redirect()->route('admin.users.index')->with('success', $msg);
    }
}

