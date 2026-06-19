<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            // ── Level-based ───────────────────────────────────────────
            [
                'name'            => 'Aksara Pertama',
                'description'     => 'Selesaikan level pertamamu!',
                'icon'            => 'workspace_premium',
                'color'           => 'secondary',
                'condition_type'  => 'first_level',
                'condition_value' => 1,
            ],
            [
                'name'            => 'Penulis Pemula',
                'description'     => 'Selesaikan 5 level pembelajaran',
                'icon'            => 'edit',
                'color'           => 'primary',
                'condition_type'  => 'levels_5',
                'condition_value' => 5,
            ],
            [
                'name'            => 'Juru Tulis',
                'description'     => 'Selesaikan 10 level pembelajaran',
                'icon'            => 'history_edu',
                'color'           => 'tertiary',
                'condition_type'  => 'levels_10',
                'condition_value' => 10,
            ],
            [
                'name'            => 'Ahli Aksara',
                'description'     => 'Selesaikan 20 level pembelajaran',
                'icon'            => 'auto_stories',
                'color'           => 'primary',
                'condition_type'  => 'levels_20',
                'condition_value' => 20,
            ],

            // ── Streak-based ──────────────────────────────────────────
            [
                'name'            => 'Konsisten',
                'description'     => 'Belajar 3 hari berturut-turut',
                'icon'            => 'local_fire_department',
                'color'           => 'secondary',
                'condition_type'  => 'streak_3',
                'condition_value' => 3,
            ],
            [
                'name'            => '7 Hari Beruntun',
                'description'     => 'Belajar 7 hari berturut-turut',
                'icon'            => 'hotel_class',
                'color'           => 'tertiary',
                'condition_type'  => 'streak_7',
                'condition_value' => 7,
            ],
            [
                'name'            => 'Dedikasi Penuh',
                'description'     => 'Belajar 30 hari berturut-turut!',
                'icon'            => 'military_tech',
                'color'           => 'primary',
                'condition_type'  => 'streak_30',
                'condition_value' => 30,
            ],

            // ── XP-based ─────────────────────────────────────────────
            [
                'name'            => 'Bintang Baru',
                'description'     => 'Kumpulkan total 100 XP',
                'icon'            => 'stars',
                'color'           => 'secondary',
                'condition_type'  => 'xp_100',
                'condition_value' => 100,
            ],
            [
                'name'            => 'Pejuang Aksara',
                'description'     => 'Kumpulkan total 500 XP',
                'icon'            => 'bolt',
                'color'           => 'tertiary',
                'condition_type'  => 'xp_500',
                'condition_value' => 500,
            ],
            [
                'name'            => 'Master Aksara',
                'description'     => 'Kumpulkan total 1000 XP!',
                'icon'            => 'diamond',
                'color'           => 'primary',
                'condition_type'  => 'xp_1000',
                'condition_value' => 1000,
            ],
        ];

        foreach ($achievements as $data) {
            Achievement::firstOrCreate(
                ['condition_type' => $data['condition_type']],
                $data
            );
        }

        $this->command->info('✅ ' . count($achievements) . ' achievements seeded.');
    }
}

