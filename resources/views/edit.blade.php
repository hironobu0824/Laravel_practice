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
        <form action='/posts/{{ $post->id }}' method="POST">
            {{ csrf_field() }}
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れ様でした。">{{ $post->body }}</textarea>
            </div>
            <div class="category">
                <h2>カテゴリ</h2>
                <select name="post[categories][]" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (in_array($category->id,$post->categories->pluck('id')->all())
                                selected
                            @endif
                        >
                        {{ $category->name }}    
                        </option>
                </select>
            </div>
            <input type="submit" value="update"/>
        </form>
        <div class="back">[<a href="/posts/{{ $post->id }}">back</a>]</div>
    </body>
</html>
