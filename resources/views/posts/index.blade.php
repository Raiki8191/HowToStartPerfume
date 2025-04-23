@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- ページタイトル -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Perfumuse Posts</h1>

        <!-- 新規投稿ボタン（上部・認証ユーザーのみ） -->
        @auth
        <div class="mb-8 text-right">
            <a href="{{ route('posts.create') }}"
                class="inline-block px-5 py-2 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                ＋ 新規投稿
            </a>
        </div>
        @endauth

        <!-- 投稿カード一覧 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col overflow-hidden">
                <!-- 情報ブロック -->
                <div class="p-4 flex-1 flex flex-col">
                    <!-- タイトル -->
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">
                        <a href="{{ url('/posts/'.$post->id) }}" class="hover:text-indigo-600 transition">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- 写真（タイトルの下）-->
                    @if($post->image)
                    <div class="w-full h-48 mb-4 overflow-hidden rounded">
                        <img src="{{ $post->image }}" alt="投稿画像" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <!-- ブランド・香水名・抜粋 -->
                    <p class="text-sm text-gray-700 mb-1"><span class="font-medium">ブランド:</span> {{ $post->brand }}</p>
                    <p class="text-sm text-gray-700 mb-3"><span class="font-medium">香水名:</span> {{ $post->perfume_name }}</p>
                    <p class="text-sm text-gray-600 flex-1">{{ Str::limit($post->content, 80) }}</p>
                </div>

                <!-- 日付＆いいね数 -->
                <div class="px-4 py-3 bg-gray-50 flex items-center justify-between text-sm text-gray-500">
                    <span>{{ $post->created_at->format('Y年n月j日') }}</span>
                    <span>♡ {{ $post->likes->count() }} いいね</span>
                </div>

                <!-- 削除ボタン（権限ありのみ） -->
                @can('delete', $post)
                <div class="px-4 py-2 bg-white border-t border-gray-200 text-right">
                    <button type="button"
                        onclick="deletePost({{ $post->id }})"
                        class="text-red-500 hover:underline text-sm">
                        削除
                    </button>
                </div>
                @endcan
            </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>

        <!-- 新規投稿ボタン（下部・モバイル対応） -->
        @auth
        <div class="mt-6 text-center">
            <a href="{{ route('posts.create') }}"
                class="inline-block px-5 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                ＋ 新規投稿
            </a>
        </div>
        @endauth
    </div>
</div>

<!-- 削除確認スクリプト（変更なし） -->
<script>
    function deletePost(id) {
        'use strict'
        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
@endsection