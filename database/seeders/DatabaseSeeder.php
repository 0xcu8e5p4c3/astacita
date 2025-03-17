<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tags;
use App\Models\Comments;
use App\Models\View;
use App\Models\Like;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Seed Users with different roles
        $roles = ['user', 'author', 'editor'];
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => $roles[array_rand($roles)], // Assign random role
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Categories
        $categories = ['Technology', 'Crypto', 'Innovation'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => strtolower($category)
            ]);
        }

        // Seed Articles
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => $faker->sentence,
                'slug' => $faker->slug,
                'content' => $faker->paragraphs(3, true),
                'author_id' => rand(1, 10),
                'editor_id' => rand(1, 10),
                'category_id' => rand(1, 3),
                'status' => $faker->randomElement(['draft', 'scheduled', 'published']),
                'published' => $faker->boolean,
                'published_at' => $faker->boolean ? now() : null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Tagss
        $Tagss = ['AI', 'Blockchain', 'Startups', 'Web3', 'Fintech'];
        foreach ($Tagss as $Tags) {
            Tags::create(['name' => $Tags]);
        }

        // Seed Commentss
        for ($i = 0; $i < 100; $i++) {
            Comments::create([
                'article_id' => rand(1, 50),
                'user_id' => rand(1, 10),
                'content' => $faker->sentence,
                'created_at' => now()
            ]);
        }

        // Seed Views
        for ($i = 0; $i < 100; $i++) {
            View::create([
                'article_id' => rand(1, 50),
                'ip_address' => $faker->ipv4,
                'visited_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Likes
        for ($i = 0; $i < 100; $i++) {
            Like::create([
                'user_id' => rand(1, 10),
                'article_id' => rand(1, 50),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
