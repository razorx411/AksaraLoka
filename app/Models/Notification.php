<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'body', 'type', 'icon'];

    /**
     * Users who received this notification (via pivot).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications')
            ->withPivot('read_at', 'created_at');
    }

    /**
     * Broadcast this notification to all regular users.
     */
    public function broadcastToAll(): void
    {
        $userIds = User::where('role', 'user')->pluck('id');
        $now     = now();

        $records = $userIds->map(fn ($id) => [
            'user_id'         => $id,
            'notification_id' => $this->id,
            'created_at'      => $now,
        ])->toArray();

        // Use chunked insert to avoid memory issues with many users
        foreach (array_chunk($records, 500) as $chunk) {
            \Illuminate\Support\Facades\DB::table('user_notifications')
                ->insertOrIgnore($chunk);
        }
    }
}

