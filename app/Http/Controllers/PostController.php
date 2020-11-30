<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Comment;

class PostController extends Controller
{
   public function index(Post $post)
   {
       return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
   }
 
   public function show(Post $post)
   {
      return view('posts/show')->with([
        'post' => $post,
        'comments' => $post->getCommentsPaginate(),
      ]);
   }

   public function create(Category $category)
   {
       return view('posts/create')->with(['categories' => $category->all()]);
   }

   public function store(PostRequest $request, Post $post)
   {
       $input = $request['post'];
       $created_post = $post->createWithRelation($input);
       return redirect('/posts/' . $created_post->id);
   }
     
   public function edit(Post $post, Category $category)
   {
      return view('posts/edit')->with([
         'post' => $post->findOrFail($post->id),
         'categories' => $category->all(),
         
      ]);
   }
    
   public function update(PostRequest $request, Post $post)
   {
       $input = $request['post'];
       $target_post = $post->updateWithRelation($input);
       return redirect('/posts/' . $target_post->id);
   }
   
   public function destroy(Post $post)
   {
      $post->deleteWithRelation();
      return redirect('/');
   }
}
