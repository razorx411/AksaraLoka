<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'Test User',
                'email' => 'test@example.com',
                'password' => '$2y$12$hciLSmaXI9tq11AcXxw2B.bw58hLEOHqE3Jk95myrDwEID4XYLBki',
                'bio' => 'Omnis repellendus dolores voluptas quaerat.',
                'avatar' => null,
                'total_points' => 4906,
                'streak_count' => 17,
                'created_at' => '2026-05-07 20:44:41',
                'updated_at' => '2026-05-07 20:44:41',
            ],

            [
                'id' => 2,
                'username' => 'Hafid Fathurrohman',
                'email' => 'hafidfr1602@gmail.com',
                'password' => '$2y$12$.XdplpK8pOesZ.7BQ77f0uDdEsa3SDECjmrfFrBy3tqU97VqRHxu2',
                'bio' => null,
                'avatar' => null,
                'total_points' => 0,
                'streak_count' => 0,
                'created_at' => '2026-05-07 23:05:21',
                'updated_at' => '2026-05-07 23:05:21',
            ],
        ]);
    }
}