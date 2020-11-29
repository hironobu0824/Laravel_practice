<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!--<link rel="stylesheet" href="./public/css/app.css">-->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    </head>
    <body>
    <header>
        <p class="blogname">高橋宏暢のブログ</p>
        <div class="mycontainer">
            <p class="edit item"><a class="btn btn1" href="/posts/{{ $post->id }}/edit"><i class="far fa-edit"></i>edit</a></p>
            <form action="/posts/{{ $post->id }}" id="form_delete" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" style="display:none">
                <p class="delete item"><span class="btn btn1" onclick="return deletePost(this);"><i class="far fa-trash-alt"></i>delete</span></p>
            </form>
            <div class="category_view item">
                @foreach($post->categories as $category)
                  <p># {{ $category->name }}</p>
                @endforeach
            </div>
        </div>
    </header>
    <main>
        <p class="heading">Author</p>
        <div class="content">
           <p>{{ optional($post->user)->name }}</p>
        </div>
        <p class="heading">Title</p>
        <div class="content">
           <h3>{{ $post->title }}</h3>
        </div>
        <p class="heading">本文</p>
        <div class="content">
           <p class=>{{ $post->body }}</p>    
        </div>
        <div>
            @if($post->is_liked_by_auth_user())
                <a href="{{ route('post.unlike',['id' => $post->id])  }}" class="btn">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
            @else
               <a href="{{ route('post.like',['id' => $post->id])  }}" class="btn">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
            @endif
        </div>
        <div class="content_comment">
            <p class="heading">コメント</p>
            <div class="content">
                @if (!$post->comments->isEmpty())
                   @foreach($comments as $comment)
                     <div class="comment">
                         <p class="comment_body">{{ $comment->body }}</p>
                         <p>
                             <span class="comment_name">By {{ $comment->name }}</span>
                             <span class="comment_date">( {{ $comment->updated_at }} )</span>
                         </p>
                     </div>
                   @endforeach
                   {{ $comments->links('pagination::semantic-ui') }}
                @endif
            </div>
        <div>
            
        <div class="content__comment__form">
            <form action="/posts/{{ $post->id }}/comment" method="POST">
                {{ csrf_field() }}
                <p>コメント入力フォーム</p>
                <div class="content__comment__form__name">
                  <h5 class="content__comment__form__name__title">Name</h5>
                  <input type="text" name="comment[name]" placeholder="名無しさん" value="{{ old('comment.name') }}" class="content__comment__form__name__input">
                  <p class="error" style="color:red">{{ $errors->first('comment.name') }}</p>
                </div>
                <div class="content__comment__form__body">
                  <h5 class="content__comment__form__body__title">Content</h5>
                  <input type="text" name="comment[body]" placeholder="コメントする" value="{{ old('comment.body') }}" class="content__comment__form__body__input">
                  <p class="error" style="color:red">{{ $errors->first('comment.body') }}</p>
                </div>
                <button type="submit" class="button1">
                    送信
                </button>
            </form>
        </div>
        <div class="back"><a href='/'><i class="fas fa-long-arrow-alt-left"></i></a></div>
    </main>
        <script>
            function deletePost(e){
                'use strict';
                if (confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById('form_delete').submit();
                }
            }
            
        </script>
    </body>
</html>


