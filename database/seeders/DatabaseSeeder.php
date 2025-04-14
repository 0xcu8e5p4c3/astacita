<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tags;
use App\Models\Comments;
use App\Models\View;
use App\Models\Like;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Seed Users
        $roles = ['user', 'author', 'editor'];
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => $roles[array_rand($roles)],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Categories
        $categoryNames = ['AI', 'Crypto', 'Start Up', 'Oke Gas', 'Kabinet', 'BUMN'];
        $categories = [];
        foreach ($categoryNames as $category) {
            $categories[] = Category::create([
                'name' => $category,
                'slug' => strtolower(str_replace(' ', '-', $category))
            ]);
        }

        // Seed Articles + Cover Image
        $articles = [];
        for ($i = 1; $i <= 100; $i++) {
            $article = Article::create([
                'title' => $faker->sentence,
                'slug' => $faker->slug,
                'content' => $faker->paragraphs(3, true),
                'author_id' => rand(1, 10),
                'editor_id' => rand(1, 10),
                'category_id' => $categories[array_rand($categories)]->id,
                'status' => 'published',
                'published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'is_featured' => (bool) rand(0, 1),

            ]);

            // Simpan article untuk digunakan nanti
            $articles[] = $article;

            // Tambahkan cover ke tabel media (Menggunakan Picsum)
            Media::create([
                'article_id' => $article->id,
                'file_path' => "https://picsum.photos/seed/{$i}/800/450", // Generate random cover image
                'file_type' => 'image',
                'mime_type' => 'image/jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Tags (10 tags random)
        $tagNames = ['AI', 'Blockchain', 'Web3', 'DeFi', 'NFT', 'Metaverse', 'Cybersecurity', 'Fintech', 'IoT', 'Big Data'];
        $tags = [];
        foreach ($tagNames as $tag) {
            $tags[] = Tags::create(['name' => $tag]);
        }

        // Assign 5 random tags to each article
        foreach ($articles as $article) {
            $randomTags = collect($tags)->random(5);
            foreach ($randomTags as $tag) {
                DB::table('article_tag')->insert([
                    'article_id' => $article->id,
                    'tag_id' => $tag->id
                ]);
            }
        }

        // Seed Comments
        for ($i = 0; $i < 100; $i++) {
            Comments::create([
                'article_id' => rand(1, 100),
                'user_id' => rand(1, 10),
                'content' => $faker->sentence,
                'created_at' => now()
            ]);
        }

        // Seed Views
        for ($i = 0; $i < 1000; $i++) {
            View::create([
                'article_id' => rand(1, 100),
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
                'article_id' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
