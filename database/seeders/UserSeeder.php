<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin account
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Prevent duplicate entry
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 1, // 1 = Admin
            ]
        );
        User::updateOrCreate(
            ['email' => 'user@gmail.com'], // Prevent duplicate entry
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 0, // 1 = Admin
            ]
        );
        User::updateOrCreate(
            ['email' => 'ernel@gmail.com'], // Prevent duplicate entry
            [
                'name' => 'ernel',
                'email' => 'ernel@gmail.com',
                'password' => Hash::make('ernel123'),
                'role' => 0, // 1 = Admin
            ]
        );
        User::updateOrCreate(
            ['email' => 'ako@gmail.com'], // Prevent duplicate entry
            [
                'name' => 'Meow',
                'email' => 'meow@gmail.com',
                'password' => Hash::make('meowl123'),
                'role' => 0, // 1 = Admin
            ]
        );
    }
}
