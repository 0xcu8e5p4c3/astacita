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
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
            [
                'name' => 'Author',
                'email' => 'author@gmail.com',
                'password' => Hash::make('author123'),
                'role' => 'author',
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('editor123'),
                'role' => 'editor',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
