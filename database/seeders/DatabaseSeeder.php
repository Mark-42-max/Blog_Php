<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Category::truncate();
        Post::truncate();

        $user = User::factory(1)->create();

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family',
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work',
        ]);

        $hobby = Category::create([
            'name' => 'Hobby',
            'slug' => 'hobby',
        ]);

        Post::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'My Family',
            'slug' => 'my-family',
            'excerpt' => 'My Family is the best',
            'body' => 'My Family is the best reset your application successful_response',
        ]);

        Post::create([
            'user_id' => 2,
            'category_id' => 2,
            'title' => 'My Work',
            'slug' => 'my-work',
            'excerpt' => 'My Work is the best',
            'body' => 'My Work is the best reset your application successful_response',
        ]);

        Post::create([
            'user_id' => 3,
            'category_id' => 3,
            'title' => 'My Hobby',
            'slug' => 'my-hobby',
            'excerpt' => 'My Hobby is the best',
            'body' => 'My Hobby is the best reset your application successful_response',
        ]);
    }
}
