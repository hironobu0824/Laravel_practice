<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;


class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post, Comment $comment)
    {
        $input = $request['comment'];
        $post->comments()->create($input);
        return redirect('/posts/' . $post->id);
    }
}
