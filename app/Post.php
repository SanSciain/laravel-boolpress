<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
    ];

    //Function to create a unique slug
    public static function createSlug($title)
    {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $find_slug = Post::where('slug', $slug)->first();
        while ($find_slug) {
            $slug = $base_slug . '-' . $count;
            $find_slug = Post::where('slug', $slug)->first();
            $count++;
        }
        return $slug;
    }
}
