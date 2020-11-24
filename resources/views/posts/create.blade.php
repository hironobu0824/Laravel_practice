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
        <p class="blogname">高橋宏暢のブログ</p>
        <form action="/posts" method="POST">
            {{ csrf_field() }}
            <div class="title">
                <p class="heading">Title</p>
                <div class="content">
                    <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                    <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
                </div>
            </div>
            <div class="body">
                <p class="heading">Body</p>
                <div class="content"> 
                    <textarea name="post[body]" placeholder="今日も1日お疲れ様でした。">{{ old('post.body') }}</textarea>
                    <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>
            </div>
            <div class='category'>
                <p class="heading">カテゴリ</p>
                <div class="content content_category">
                    <select name="post[categories][]" multiple>
                        <option value="" hidden>カテゴリを選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back"><a href='/'><i class="fas fa-long-arrow-alt-left"></i></a></div>
    </body>
</html>
