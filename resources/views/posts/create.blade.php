@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <!-- タイトル -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">新規投稿</h1>

        <form action="/posts" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- タイトル -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" name="post[title]" id="title" placeholder="タイトル"
                    value="{{ old('post.title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('post.title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 内容 -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea name="post[content]" id="content" rows="5" placeholder="感想や魅力を自由に表現してください"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('post.content') }}</textarea>
                @error('post.content')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ブランド -->
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">ブランド</label>
                <input type="text" name="post[brand]" id="brand" placeholder="例：Etat Libre d'Orange"
                    value="{{ old('post.brand') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('post.brand')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 香水名 -->
            <div>
                <label for="perfume_name" class="block text-sm font-medium text-gray-700">香水名</label>
                <input type="text" name="post[perfume_name]" id="perfume_name" placeholder="香水の名称（例：世界の終わり）"
                    value="{{ old('post.perfume_name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('post.perfume_name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 画像 -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">写真（任意）</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                @error('post.image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="flex justify-between items-center">
                <a href="/" class="text-indigo-600 hover:underline text-sm">← 戻る</a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-semibold rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    保存する
                </button>
            </div>
        </form>
    </div>
</div>
@endsection