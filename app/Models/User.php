<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Pastikan baris ini di-import

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // 2. Tambahkan SoftDeletes di sini

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'streak_count',
        'total_points',
    ];

    /**
     * Check if user has admin role.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get user level based on total XP.
     * XP_CONFIG: baseXP = 300, increment = 200, maxLevel = 50
     */
    public function getUserLevel(): int
    {
        $xp = $this->total_points;
        $lvl = 1;
        $cumulative = 0;
        
        while ($lvl < 50) {
            $cumulative += 300 + ($lvl - 1) * 200;
            if ($xp < $cumulative) {
                break;
            }
            $lvl++;
        }
        
        return $lvl;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get user progress for learning levels.
     */
    public function levelProgress()
    {
        return $this->hasMany(UserLevelProgress::class);
    }

    /**
     * Backward compatibility accessors.
     */
    public function getNamaAttribute()
    {
        return $this->username;
    }

    public function getStreakAttribute()
    {
        return $this->streak_count;
    }

    public function getXpAttribute()
    {
        return $this->total_points;
    }
}