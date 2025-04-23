@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- 画像表示（切り抜きなし） --}}
        @if($post->image)
        <div class="w-full mb-6">
            <img src="{{ $post->image }}"
                alt="投稿画像"
                class="w-full h-auto object-contain">
        </div>
        @endif

        <div class="p-8 space-y-6">
            <!-- 以下、既存のコンテンツ部分 -->
            <h1 class="text-4xl font-serif font-semibold text-gray-800">{{ $post->title }}</h1>

            <p class="text-gray-700 text-sm"><span class="font-semibold">ブランド名:</span> {{ $post->brand }}</p>
            <p class="text-gray-700 text-sm"><span class="font-semibold">香水名:</span> {{ $post->perfume_name }}</p>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $post->content }}</p>
            <p class="text-gray-400 text-xs">投稿日: {{ $post->created_at->format('Y年n月j日') }}</p>

            @auth
            <div class="flex items-center gap-4">
                <form action="{{ route('posts.toggle_like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-pink-500 hover:text-pink-600">
                        @if(auth()->user()->likedPosts->contains($post->id))
                        💔 いいね解除
                        @else
                        ❤️ いいね
                        @endif
                    </button>
                </form>
                <span class="text-sm text-gray-600">{{ $post->likes_count }} 件のいいね</span>
            </div>
            @endauth

            @auth
            <div class="mt-8">
                <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-2">
                    @csrf
                    <textarea name="content" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
                        placeholder="コメントを追加..."></textarea>
                    <button type="submit"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition">
                        コメントする
                    </button>
                </form>
            </div>
            @endauth

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700">コメント一覧</h3>
                <div class="space-y-2 mt-2">
                    @foreach ($post->comments as $comment)
                    <div class="border-b border-gray-200 pb-2">
                        <p class="text-sm text-gray-800">
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                    class="text-sm text-blue-600 hover:underline">
                    編集
                </a>
                @endcan
                <a href="/posts"
                    class="text-sm text-gray-500 hover:underline">
                    ← 戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection