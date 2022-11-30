<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function feed() {
        return view('feed');
    }

    public function new() {
        return view('create_post');
    }
}
