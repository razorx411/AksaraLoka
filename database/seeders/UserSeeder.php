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
                'nama' => 'Test User',
                'email' => 'test@example.com',
                'email_verified_at' => '2026-05-07 20:44:40',
                'password' => '$2y$12$hciLSmaXI9tq11AcXxw2B.bw58hLEOHqE3Jk95myrDwEID4XYLBki',
                'bio' => 'Omnis repellendus dolores voluptas quaerat.',
                'avatar' => null,
                'xp' => 4906,
                'level' => 10,
                'streak' => 17,
                'remember_token' => 'uNelxHLW2c',
                'created_at' => '2026-05-07 20:44:41',
                'updated_at' => '2026-05-07 20:44:41',
            ],

            [
                'id' => 2,
                'nama' => 'Hafid Fathurrohman',
                'email' => 'hafidfr1602@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$.XdplpK8pOesZ.7BQ77f0uDdEsa3SDECjmrfFrBy3tqU97VqRHxu2',
                'bio' => null,
                'avatar' => null,
                'xp' => 0,
                'level' => 1,
                'streak' => 0,
                'remember_token' => null,
                'created_at' => '2026-05-07 23:05:21',
                'updated_at' => '2026-05-07 23:05:21',
            ],
        ]);
    }
}