@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title">{{ $post->title }}</h1>

    <div class="content">
        <p class="text-red-400"><strong>内容:</strong> {{ $post->content }}</p>
        <p><strong>ブランド名:</strong> {{ $post->brand }}</p>
        <p><strong>香水名:</strong> {{ $post->perfume_name }}</p>
        @if($post->image)
        <div>
            <img src="{{ $post->image }}" alt="画像が読み込めません。">
        </div>
        @endif

        {{-- いいね機能 --}}
        @auth
        <div>
            <form action="{{ route('posts.toggle_like', $post->id) }}" method="POST">
                @csrf
                <button type="submit">
                    @if(auth()->user()->likedPosts->contains($post->id))
                    💔 いいね解除
                    @else
                    ❤️ いいね
                    @endif
                </button>
            </form>

        </div>
        @endauth

        @if (Auth::check())
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <textarea name="content" required></textarea>
            <button type="submit">コメントする</button>
        </form>
        @endif
        <h3>コメント一覧</h3>
        @foreach ($post->comments as $comment)
        <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
        @endforeach

    </div>

    <div class="actions">
        @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">編集</a>
        @endcan
        <a href="/">戻る</a>{{-- 本当は  <a href="/posts">戻る</a> とする予定だったがweb.phpで/の移動先を編集中なのでこうしている　--}}
    </div>
</div>
@endsection