<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    </head>
    <body>
        <div class="login_register_container">
            <!--<a href="/login"><p>ログイン</p></a>-->
            <!--<a class="register_botton" href="/register"><p>新規登録</p></a>-->
            @if (Route::has('login'))
                <div class="top-right links">
                   @auth
                      <a href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                   @else
                      <a href="{{ route('login') }}">ログイン</a>
                      @if (Route::has('register'))
                        <a href="{{ route('register') }}">新規登録</a>
                      @endif
                   @endauth
                </div>
            @endif
        </div>
        <h1 class="Title_name">高橋宏暢のブログ</h1>
            <p class="create"><a class="btn btn1" href="/post/create"><i class="fas fa-pen"></i>新規作成</a></p>
            <p class="heading">Blog index</p>
            <div class="content">
                <div class='posts'>
                    @foreach ($posts as $post)
                      <div class='post'>
                         <p class='post_title'><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></p>
                         <p class='post_body'>{{ $post->body }}</p>
                      </div>
                    @endforeach
                </div>
            </div>
        <div class='paginate'>
            {{ $posts->links('pagination::default') }}
        </div>
    </body>
</html>
