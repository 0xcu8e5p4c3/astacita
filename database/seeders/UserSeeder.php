<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User Default',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Author Example',
                'email' => 'author@example.com',
                'password' => Hash::make('password'),
                'role' => 'author',
            ],
            [
                'name' => 'Editor Example',
                'email' => 'editor@example.com',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
