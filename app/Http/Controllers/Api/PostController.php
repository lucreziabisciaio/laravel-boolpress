<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use SlugGenerator;

    public function index()
    {
        $posts = Post::paginate(5);

        $posts->load("user", "category");

        $posts->each(function($post){
            if($post->cover) {
                $post->cover = asset('storage/' . $post->cover);
            } else {
                $post->cover = "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png";
            }
        });

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|min:5",
            "content" => "required|min:20",
            "category_id" => "nullable",
            "tags" => "nullable"
        ]);

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->user_id = 1;
        $newPost->slug = $this->generateUniqueSlug($data["title"]);
        $newPost->save();

        if (key_exists("tags", $data)) {
            $newPost->tags()->attach($data["tags"]);
        }

        return response()->json($newPost);
    }

    public function show($slug)
    {
        $post = Post::where("slug", $slug)
            ->with(["tags", "user", "category"])
            ->first();

        // $post->load(["tags", "user", "category"]);

        if (!$post) {
            abort(404);
        }

        return response()->json($post);
    }
}
