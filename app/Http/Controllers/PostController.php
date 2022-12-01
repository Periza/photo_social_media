<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Post;


class PostController extends Controller
{
    public function feed() {

        $posts = Post::orderBy('created_at', 'desc')->paginate(6);

        return view('feed')->with('posts', $posts);
    }

    public function new() {
        return view('create_post');
    }

    public function create(PostRequest $request) {
        $data = $request->validated();

        // get image
        $image = $request->file('userfile');

        // generate unique name
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // save the image
        $path = $image->storeAs('public/images', $fileName);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->image = $path;
        $post->title = $request->input('title');
        $post->save();


        return redirect()->route('feed');
    }
}
