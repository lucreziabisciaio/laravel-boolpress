<?php
// FAKER

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $newPost = new Post();

            $newPost->title = $faker->sentence(3);
            $newPost->content = $faker->text(100);
            $newPost->slug = Str::slug($newPost);
            $newPost->user_id = 1;
            $newPost->category_id = 1;

            $newPost->save();
        }
    }
}
