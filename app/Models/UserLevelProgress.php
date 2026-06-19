<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevelProgress extends Model
{
    protected $table = 'user_level_progress';

    protected $fillable = ['user_id', 'level_id', 'is_completed', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

