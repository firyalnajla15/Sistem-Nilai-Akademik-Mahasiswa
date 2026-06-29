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
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Admin Akademik',
                'email' => 'admin@gmail.com',
                'nim' => null,
                'role' => 'admin',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}