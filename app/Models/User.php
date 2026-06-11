<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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
        'bio',
        'avatar',
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
        $xp  = $this->total_points;
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
     * Get the streak multiplier based on streak count.
     */
    public function streakMultiplier(): float
    {
        $streak = $this->streak_count;
        if ($streak >= 30) return 1.5;
        if ($streak >= 14) return 1.3;
        if ($streak >= 7)  return 1.2;
        if ($streak >= 3)  return 1.1;
        return 1.0;
    }

    /**
     * Public URL for avatar, or null if none.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return null;
    }

    // ── Relationships ────────────────────────────────────────

    public function levelProgress()
    {
        return $this->hasMany(UserLevelProgress::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(
            \App\Models\Notification::class,
            'user_notifications'
        )->withPivot('read_at', 'created_at');
    }

    public function achievements()
    {
        return $this->belongsToMany(
            Achievement::class,
            'user_achievements'
        )->withPivot('earned_at');
    }

    // ── Backward compatibility accessors ─────────────────────

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

    // ── Casts ────────────────────────────────────────────────

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_activity_date' => 'date',
    ];
}