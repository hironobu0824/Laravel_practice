<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(Post $post)
     {
         return view('index')->with(['posts' => $post->getPaginateByLimit(1)]);
     }
}
