<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Message;
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
        //only run seeders if the database is empty

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();
        $user4 = User::factory()->create();
        Post::factory(3)->create([
            'user_id' => $user1->id,
        ]);

        Post::factory(3)->create([
            'user_id' => $user2->id,
        ]);

        Post::factory(3)->create([
            'user_id' => $user3->id,
        ]);

        Post::factory(3)->create([
            'user_id' => $user4->id,
        ]);
    }
}
