<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kokiku@gmail.com'],
            [
                'name' => 'Administrator',
                'email' => 'kokiku@gmail.com',
                'password' => Hash::make('dellarahmatjs12'),
                'role' => 'admin',
            ]
        );
    }
}