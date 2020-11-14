<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Category;

class PostController extends Controller
{
   public function index(Post $post)
   {
       return view('index')->with(['posts' => $post->getPaginateByLimit()]);
   }
 
   public function show(Post $post)
   {
       return view('post/show')->with([
          'post' => $post
          'comments' => $post->getCommentsPaginate();
      ]);
   }

   public function create(Category $category)
   {
       return view('posts/create')->with(['categories' => $category->all()]);
   }

   public function store(PostRequest $request, Post $post)
   {
       $input = $request['post'];
       $post->fill($input)->save();
       return redirect('/posts/' . $post->id);
   }
     
   public function edit(Post $post)
   {
       return view('edit')->with(['post' => $post]);
   }
    
   public function update(PostRequest $request,Post $post)
   {
       $input = $request['post'];
       $post->fill($input)->save();
       return redirect('/posts/' . $post->id);
   }
   
   public function destroy(Post $post)
   {
       $post->delete();
       return redirect('/');
   }
   
   public function destroy(Post $post)
   {
      $post->deleteWithRelation();
      return redirect('/');
   }
}
