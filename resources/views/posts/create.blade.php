@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- タイトル -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">新規投稿</h1>

    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="title">
            <h2>タイトル</h2>
            <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}" />
            <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <div class="content">
            <h2>内容</h2>
            <textarea name="post[content]" placeholder="例：この香水の名前になっている世界の終わりという香りをキャラメルポップコーンのような香りで表しているのがとても秀逸でおもしろい。">{{ old('post.content') }}</textarea>
            <p class="content__error" style="color:red">{{ $errors->first('post.content') }}</p>
        </div>
        <div class="brand">
            <h2>ブランド</h2>
            <input type="text" name="post[brand]" placeholder="例：Etat libre d'Orange" value="{{ old('post.brand') }}" />
            <p class="brand__error" style="color:red">{{ $errors->first('post.brand') }}</p>
        </div>
        <div class="perfume_name">
            <h2>香水名</h2>
            <input type="text" name="post[perfume_name]" placeholder="香水の表記名 例：世界の終わり" value="{{ old('post.perfume_name') }}" />
            <p class="perfume_name__error" style="color:red">{{ $errors->first('post.perfume_name') }}</p>
        </div>
        <div class="image">
            <h2>写真(任意)</h2>
            <input type="file" name="image" placeholder="写真を貼れる方はお願いします。(任意)" value="{{ old('post.image') }}" />
            <p class="image__error" style="color:red">{{ $errors->first('post.image') }}</p>
        </div>
        <input type="submit" value="保存" />
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
    @endsection('content')