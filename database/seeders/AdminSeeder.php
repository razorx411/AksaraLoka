<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@aksaraloka.id'],
            [
                'username'     => 'Admin AksaraLoka',
                'email'        => 'admin@aksaraloka.id',
                'password'     => Hash::make('admin123!'),
                'role'         => 'admin',
                'streak_count' => 0,
                'total_points' => 0,
            ]
        );
    }
}

