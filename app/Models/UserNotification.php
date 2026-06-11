<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    public $timestamps = false;

    protected $table    = 'user_notifications';
    protected $fillable = ['user_id', 'notification_id', 'read_at', 'created_at'];

    protected $casts = [
        'read_at'    => 'datetime',
        'created_at' => 'datetime',
    ];
}
