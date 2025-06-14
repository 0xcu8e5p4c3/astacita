<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile; 
use App\Models\Category;
use App\Models\Article;
use App\Models\Tags;
use Illuminate\Support\Str;
use Carbon\Carbon;
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

        // Seed 1 Editor dengan spesifikasi khusus
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        Profile::create([
            'user_id' => $editor->id,
            'alamat' => $faker->address,
            'tgl_lahir' => $faker->date(),
            'nomor_telepon' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'foto_profile' => "https://picsum.photos/seed/editor/200/200",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed 5 Authors
        $authors = [];
        for ($i = 1; $i <= 5; $i++) {
            $author = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'author',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            $authors[] = $author;
            
            Profile::create([
                'user_id' => $author->id,
                'alamat' => $faker->address,
                'tgl_lahir' => $faker->date(),
                'nomor_telepon' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female']),
                'foto_profile' => "https://picsum.photos/seed/author{$i}/200/200",
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

        // Get author IDs untuk random assignment
        $authorIds = collect($authors)->pluck('id')->toArray();

        // Seed Articles + Cover Image
        $articles = [];
        for ($i = 1; $i <= 100; $i++) {
            $article = Article::create([
                'title' => $faker->sentence,
                'slug' => $faker->slug,
                'content' => $faker->paragraphs(3, true),
                'author_id' => $authorIds[array_rand($authorIds)], // Random dari 5 authors
                'editor_id' => $editor->id, // Selalu menggunakan editor yang sama
                'category_id' => $categories[array_rand($categories)]->id,
                'status' => 'published',
                'published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'is_featured' => (bool) rand(0, 1),
            ]);

            $articles[] = $article;
            
            // Uncomment jika ingin menggunakan media/cover image
            // Media::create([
            //     'article_id' => $article->id,
            //     'file_path' => "https://picsum.photos/seed/{$i}/800/450",
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);
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

        // Get author dan editor IDs untuk comments dan likes
        $allUserIds = array_merge($authorIds, [$editor->id]);

        // Seed Comments
        for ($i = 0; $i < 100; $i++) {
            Comments::create([
                'article_id' => rand(1, 100),
                'user_id' => $allUserIds[array_rand($allUserIds)],
                'content' => $faker->sentence,
                'created_at' => now()
            ]);
        }

        // Seed Views
        // for ($i = 0; $i < 1000; $i++) {
        //     View::create([
        //         'article_id' => rand(1, 100),
        //         'ip_address' => $faker->ipv4,
        //         'visited_at' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // }

        // Seed Likes
        for ($i = 0; $i < 100; $i++) {
            Like::create([
                'user_id' => $allUserIds[array_rand($allUserIds)],
                'article_id' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
