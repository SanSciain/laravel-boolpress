<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'family friendly',
            'nsfw',
        ];

        foreach ($tags as $tag) {
            $new_tag = new Tag;
            $new_tag->name = $tag;
            $new_tag->save();
        }
    }
}
