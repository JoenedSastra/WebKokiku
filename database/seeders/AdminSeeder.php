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
            ['email' => 'kokiku@email.com'],
            [
                'name' => 'Administrator',
                'email' => 'kokiku@email.com',
                'password' => Hash::make('dellarahmatjs12'),
                'role' => 'admin',
            ]
        );
    }
}