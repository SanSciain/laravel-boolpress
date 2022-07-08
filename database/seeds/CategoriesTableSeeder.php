<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'news',
            'videogames',
            'memes',
            'sport',
            'economy',
        ];

        foreach ($categories as $item) {
            $category = new Category;
            $category->name = $item;
            $category->save();
        }
    }
}
