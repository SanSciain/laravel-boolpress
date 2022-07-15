<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->thingsToValidate());
        $data = $request->all();


        if (isset($data['image'])) {
            $image_path = Storage::put('post_thumb', $data['image']);
            $data['thumb'] = $image_path;
        }

        $new_post = new Post();
        $new_post->fill($data);
        // $new_post->slug = $this->createSlug($new_post->title);
        $new_post->slug = Post::createSlug($new_post->title);
        $new_post->save();

        if (isset($data['tags'])) {
            $new_post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->thingsToValidate());
        $data = $request->all();


        $post_to_update = Post::findOrFail($id);
        // Metodo con fill + save
        // $post_to_update->fill($data);
        // // $post_to_update->slug = $this->createSlug($post_to_update->title);
        // $post_to_update->slug = Post::createSlug($post_to_update->title);
        // $post_to_update->save();

        if (isset($data['image'])) {
            if ($post_to_update->thumb) {
                Storage::delete($post_to_update->thumb);
            }
            $image_path = Storage::put('post_thumb', $data['image']);
            $data['thumb'] = $image_path;
        }

        // Metodo con update
        $data['slug'] = Post::createSlug($data['title']);
        $post_to_update->update($data);

        if (isset($data['tags'])) {
            $post_to_update->tags()->sync($data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        $post_to_delete->tags()->sync([]);
        if ($post_to_delete->thumb) {
            Storage::delete($post_to_delete->thumb);
        }
        $post_to_delete->delete();
        return redirect()->route('admin.posts.index');
    }

    //Function to validate input from forms
    private function thingsToValidate()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:40000',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:512',
        ];
    }

    // //Function to create a unique slug messa nel controller 
    // private function createSlug($title)
    // {
    //     $base_slug = Str::slug($title, '-');
    //     $slug = $base_slug;
    //     $count = 1;
    //     $find_slug = Post::where('slug', $slug)->first();
    //     while ($find_slug) {
    //         $slug = $base_slug . '-' . $count;
    //         $find_slug = Post::where('slug', $slug)->first();
    //         $count++;
    //     }
    //     return $slug;
    // }
}
