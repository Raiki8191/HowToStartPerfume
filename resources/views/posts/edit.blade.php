<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>

<body>
    <h1 class="title">編集画面</h1>
    <div class="contents">
        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT') {{-- ここを追加！ --}}

            <label for="title">タイトル:</label>
            <input type="text" name="post[title]" value="{{ old('post.title', $post->title) }}" required>

            <label for="brand">ブランド名:</label>
            <input type="text" name="post[brand]" value="{{ old('post.brand', $post->brand) }}" required>

            <label for="perfume_name">香水名:</label>
            <input type="text" name="post[perfume_name]" value="{{ old('post.perfume_name', $post->perfume_name) }}" required>

            <label for="content">内容:</label>
            <input type="text" name="post[content]" value="{{ old('post.content', $post->content) }}" required>

            {{-- 画像を表示 --}}
            @if ($post->image)
            <div>
                <p>現在の画像:</p>
                <img src="{{ $post->image }}" alt="投稿画像" style="max-width: 300px; height: auto;">
                <br>
                <input type="checkbox" name="delete_image" value="1"> 画像を削除
            </div>
            @endif

            <label for="image">新しい写真をアップロード（任意）:</label>
            <input type="file" name="image">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</body>

</html>