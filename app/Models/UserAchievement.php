<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    public $timestamps = false;

    protected $table    = 'user_achievements';
    protected $fillable = ['user_id', 'achievement_id', 'earned_at'];

    protected $casts = [
        'earned_at' => 'datetime',
    ];
}
