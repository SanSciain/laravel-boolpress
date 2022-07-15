<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    protected $fillable = [
        'title',
        'content',
        'slug',
        'thumb',
        'category_id',
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
