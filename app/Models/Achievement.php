<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'name', 'description', 'icon', 'color',
        'condition_type', 'condition_value',
    ];

    /**
     * Users who have earned this achievement.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('earned_at');
    }

    /**
     * Evaluate all un-earned achievements for the given user.
     * Returns array of newly awarded Achievement instances.
     */
    public static function checkAndAward(User $user): array
    {
        $earnedIds      = $user->achievements()->pluck('achievement_id')->toArray();
        $completedCount = UserLevelProgress::where('user_id', $user->id)
            ->where('is_completed', true)->count();
        $streak = (int) $user->streak_count;
        $xp     = (int) $user->total_points;

        $pending = self::whereNotIn('id', $earnedIds)->get();
        $newly   = [];

        foreach ($pending as $achievement) {
            $earned = match ($achievement->condition_type) {
                'first_level' => $completedCount >= 1,
                'levels_5'    => $completedCount >= 5,
                'levels_10'   => $completedCount >= 10,
                'levels_20'   => $completedCount >= 20,
                'streak_3'    => $streak >= 3,
                'streak_7'    => $streak >= 7,
                'streak_30'   => $streak >= 30,
                'xp_100'      => $xp >= 100,
                'xp_500'      => $xp >= 500,
                'xp_1000'     => $xp >= 1000,
                default       => false,
            };

            if ($earned) {
                $user->achievements()->attach($achievement->id, ['earned_at' => now()]);
                $newly[] = $achievement;
            }
        }

        return $newly;
    }
}
