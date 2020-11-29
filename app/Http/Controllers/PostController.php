<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Comment;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   public function index(Post $post)
   {
       return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
   }
 
   public function show(Post $post, User $user)
   {
      return view('posts/show')->with([
       'post' => $post,
       'comments' => $post->getCommentsPaginate(),
       'user' => $user,
      ]);
   }

   public function create(Category $category)
   {
       return view('posts/create')->with(['categories' => $category->all()]);
   }

   public function store(PostRequest $request, Post $post)
   {
       $input = $request['post'];
       $input['user_id'] = Auth::id();
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
       $this->authorize('update',$post);
       $input = $request['post'];
       $target_post = $post->updateWithRelation($input);
       return redirect('/posts/' . $target_post->id);
   }
   
   public function destroy(Post $post)
   {
      $this->authorize('delete',$post);
      $post->deleteWithRelation();
      return redirect('/');
   }
   
   // only()の引数内のメソッドはログイン時のみ有効
   // public function __construct()
   // {
   //    $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
   // }
   public function like($id)
   {
      Like::create([
         'post_id' => $id,
         'user_id' => Auth::id(),
      ]);
      
      session()->flash('success','You Liked the Post');
      
      return redirect()->back();
   }
   
   public function unlike($id)
   {
      $like = Like::where('post_id',$id)->where('user_id',Auth::id())->first();
      $like->delete();
      
      session()->flash('success', 'You Unliked the Post.');
      
      return redirect()->back();
   }
   
   public function hello() {
      return 'hello';
   }
}
