<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guru@aksaraloka.id'],
            [
                'username'     => 'Guru AksaraLoka',
                'email'        => 'guru@aksaraloka.id',
                'password'     => Hash::make('guru123!'),
                'role'         => 'guru',
                'streak_count' => 0,
                'total_points' => 0,
                'bio'          => 'Pengajar Aksara Nusantara resmi.',
            ]
        );
    }
}

