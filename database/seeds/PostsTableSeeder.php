<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;        // <-----------   importare per utilizzare lo slug

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) {
            # code...
            $new_post = new Post();
            $new_post->title = "Titolo post " .($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = "lorem ipst ashgasdgashdgasjhdgkakjs asgd jkahsgd jkahsgda kuaieroqielwuh qasd ghkagrasgd qwehgasd";
            $new_post->save();

        }
    }
}
