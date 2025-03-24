@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title">{{ $post->title }}</h1>

    <div class="content">
        <p><strong>内容:</strong> {{ $post->content }}</p>
        <p><strong>ブランド名:</strong> {{ $post->brand }}</p>
        <p><strong>香水名:</strong> {{ $post->perfume_name }}</p>
        <p><strong>香水のイメージ:</strong> {{ $post->image }}</p>

    </div>

    <div class="actions">
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">編集</a>
        <a href="/">戻る</a>
    </div>
</div>
@endsection