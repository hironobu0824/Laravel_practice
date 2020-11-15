<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <h1>Blog name</h1>
        <p class='edit'>[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="submit" style="display:none">
            <p class='delete'>[<span onclick="return deletePost(this);">delete</span>]</p>
        </form>
        <div class="post">
            <h2 class="title">{{ $post->title }}</h2>
            <p class="body">{{ $post->body }}</p>
            <p class="updated_at">{{ $post->updated_at }}</p>
        </div>
        <div class="content_comment">
            <h3>Comments</h3>
            @if (!$post->comments->isEmpty())
               @foreach($comments as $comment)
                 <div class="content_comment_item">
                     <p class="content_comment_item_body">{{ $comment->body }}</p>
                     <p>
                         <span class="content_comment_item_name">By {{ $comment->name }}</span>
                         <span class="content_comment_item_date">By {{ $comment->updated_at }}</span>
                     </p>
                 </div>
               @endforeach
               {{ $comments->links('pagination::semantic-ui') }}
            @endif
        </div>
        
        <div class="content__comment__form">
          <form action="/posts/{{ $post->id }}/comment" method="POST">
            {{ csrf_field() }}
            <div class="content__comment__form__name">
              <h5 class="content__comment__form__name__title">Name</h5>
              <input type="text" name="comment[name]" placeholder="名無しさん" class="content__comment__form__name__input">
              <p class="error">{{ $errors->first("comment.name") }}</p>
            </div>
            <div class="content__comment__form__body">
              <h5 class="content__comment__form__body__title">Content</h5>
              <input type="text" name="comment[body]" placeholder="コメントする" class="content__comment__form__body__input">
              <p class="error">{{ $errors->first("comment.body") }}</p>
            </div>
            <input type="submit" value="Send">
          </form>
        </div>
        <div class="back">[<a href='/'>back</a>]</div>
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
