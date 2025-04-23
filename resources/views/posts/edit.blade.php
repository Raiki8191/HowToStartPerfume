@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- タイトル -->
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">投稿の編集</h1>

    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow-md rounded-xl p-8">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
            <input type="text" name="post[title]" id="title" value="{{ old('post.title', $post->title) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>

        <div>
            <label for="brand" class="block text-lg font-medium text-gray-700">ブランド名</label>
            <input type="text" name="post[brand]" id="brand" value="{{ old('post.brand', $post->brand) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>

        <div>
            <label for="perfume_name" class="block text-lg font-medium text-gray-700">香水名</label>
            <input type="text" name="post[perfume_name]" id="perfume_name" value="{{ old('post.perfume_name', $post->perfume_name) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>

        <div>
            <label for="content" class="block text-lg font-medium text-gray-700">内容</label>
            <textarea name="post[content]" id="content" rows="5"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>{{ old('post.content', $post->content) }}</textarea>
        </div>

        @if ($post->image)
        <div>
            <p class="text-sm text-gray-600 mb-2">現在の画像:</p>
            <img src="{{ $post->image }}" alt="投稿画像" class="max-w-xs rounded-md mb-2 shadow-sm">
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="delete_image" value="1" class="form-checkbox text-red-600">
                <span class="ml-2 text-sm text-gray-700">画像を削除</span>
            </label>
        </div>
        @endif

        <div>
            <label for="image" class="block text-lg font-medium text-gray-700">新しい写真（任意）</label>
            <input type="file" name="image" id="image"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded-md">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="flex justify-end space-x-4">
            <a href="{{ route('posts.show', $post->id) }}" class="text-indigo-600 hover:underline text-sm">キャンセル</a>
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">更新</button>
        </div>
    </form>
</div>
@endsection