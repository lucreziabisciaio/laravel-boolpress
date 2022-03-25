<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where("user_id", Auth::user()->id)
            ->withTrashed()->get();

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|min:5",
            "content" => "required|min:10",
            "category_id" => "nullable",
            "cover" => "nullable|max:500",
        ]);

        $post = new Post();
        $post->fill($data);

        $slug = Str::slug($post->title);
        $exists = Post::where('slug', $slug)->first();
        $counter = 1;

        while($exists){
            $newSlug = $slug . "-" . $counter;
            $counter++;
            $exists = Post::where('slug', $newSlug)->first();

            if(!$exists){
                $slug = $newSlug;
            }
        }

        $post->slug = $slug;
        $post->user_id = Auth::user()->id;

        if (key_exists("cover", $data)) {
            $post->cover = Storage::put("postCovers", $data["cover"]);
        }

        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", [
            "post" => $post,
            "categories" => $categories,
            "tags" => $tags,
        ]);
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
        $data = $request->validate([
            "title" => "required|min:5",
            "content" => "required|min:20",
            "category_id" => "nullable|exists:categories,id",
            "tags" => "nullable|exists:tags,id",
            "cover" => "nullable|max:500",
        ]);

        $post = Post::findOrFail($id);

        if($data["title"] !== $post->title){
            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }

        $post->update($data);

        if (key_exists("cover", $data)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }

            $cover = Storage::put("postCovers", $data["cover"]);

            $post->cover = $cover;
            $post->save();
        }

        if(key_exists("tags", $data)){
            $post->tags()->sync($data["tags"]);
        }

        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->tags()->detach();

            if ($post->cover) {
                Storage::delete($post->cover);
            }

            $post->forceDelete();
        } else {
            // soft delete
            $post->delete();
        }

        return redirect()->route("admin.posts.index");
    }

    // slug generator function
    protected function generateUniqueSlug($postTitle)
    {
        // creates slug from post title
        $slug = Str::slug($postTitle);

        // checks duplicated slugs in db
        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        // while $exists variable returns a value != null or false
        while ($exists) {
            // creates a new slug from prev slug + links incremental number to it
            $newSlug = $slug . "-" . $counter;
            $counter++;

            // checks duplicated slugs again
            $exists = Post::where("slug", $newSlug)->first();

            // IF the new slugs doesnt have duplicates, saves the new slug into $slug variable
            if (!$exists) {
                $slug = $newSlug;
            }
        }

        return $slug;
    }
}
