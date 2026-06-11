<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * GET /api/notifications
     * Returns all notifications for the authenticated user (unread first).
     */
    public function index()
    {
        $user = Auth::user();

        $unreadCount = UserNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        $notifications = $user->notifications()
            ->orderByRaw('user_notifications.read_at IS NOT NULL ASC')
            ->orderBy('notifications.created_at', 'desc')
            ->get()
            ->map(fn ($n) => [
                'id'         => $n->id,
                'title'      => $n->title,
                'body'       => $n->body,
                'type'       => $n->type,
                'icon'       => $n->icon,
                'is_read'    => ! is_null($n->pivot->read_at),
                'created_at' => $n->created_at->diffForHumans(),
            ]);

        return response()->json([
            'success'      => true,
            'unread_count' => $unreadCount,
            'notifications'=> $notifications,
        ]);
    }

    /**
     * POST /api/notifications/{id}/read
     */
    public function markRead(int $id)
    {
        UserNotification::where('user_id', Auth::id())
            ->where('notification_id', $id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * POST /api/notifications/read-all
     */
    public function markAllRead()
    {
        UserNotification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
