<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|max:2000',
            'type'  => 'required|in:info,materi,soal',
            'icon'  => 'required|string|max:100',
        ], [
            'title.required' => 'Judul notifikasi wajib diisi.',
            'body.required'  => 'Isi notifikasi wajib diisi.',
            'type.in'        => 'Tipe harus salah satu dari: info, materi, soal.',
        ]);

        $notification = Notification::create($data);

        // Broadcast to all regular users
        $notification->broadcastToAll();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dikirim ke semua pengguna!');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dihapus.');
    }
}
