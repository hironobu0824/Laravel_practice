<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;

class PostController extends Controller
{
   public function store(CommentRequest $request, Post $post, Comment $comment)
   {
       $input = $request['comment'];
       $post->comments()->create($input);
       return redirect('/posts/' . $post->id);
   }
    
}