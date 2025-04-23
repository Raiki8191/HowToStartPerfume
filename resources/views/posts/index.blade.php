@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- タイトル -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Perfumuse posts</h1>

    <!-- 新規投稿ボタン（カードの外） -->
    @auth
    <div class="mb-6 text-center">
        <a href='/posts/create' class="inline-block px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
            ＋ 新規投稿
        </a>
    </div>
    @endauth

    <!-- 投稿カード一覧 -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
        <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between h-full">
            @if($post->image)
            <div class="mb-4">
                <img src="{{ $post->image }}" alt="投稿画像" class="rounded w-full h-48 object-cover">
            </div>
            @endif

            <div class="flex-1">
                <h2 class="text-xl font-bold mb-2">
                    <a href="/posts/{{ $post->id }}" class="text-indigo-600 hover:underline">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-gray-700 mb-1">ブランド名: {{ $post->brand }}</p>
                <p class="text-sm text-gray-700 mb-1">香水名: {{ $post->perfume_name }}</p>
                <p class="text-sm text-gray-600 mb-3">{{ Str::limit($post->content, 100) }}</p>
            </div>

            <div class="mt-4 flex justify-between text-sm text-gray-500">
                <span>{{ $post->created_at->format('Y年n月j日') }}</span>
                <span>♡ {{ $post->likes->count() }} いいね</span>
            </div>

            @can('delete', $post)
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})" class="text-red-500 hover:underline text-sm">
                    削除
                </button>
            </form>
            @endcan
        </div>
        @endforeach
    </div>

    <!-- ページネーション -->
    <div class='mt-8'>
        {{ $posts->links() }}
    </div>

    <!-- フッターにも投稿ボタン（モバイル対応） -->
    @auth
    <div class="mt-6 text-center">
        <a href='/posts/create' class="inline-block px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
            ＋ 新規投稿
        </a>
    </div>
    @endauth
</div>

<!-- 削除確認スクリプト -->
<script>
    function deletePost(id) {
        'use strict'
        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
@endsection