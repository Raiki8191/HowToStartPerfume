<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    {{-- スマホでの表示に対応させるための記述 --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfumuse - Home</title>{{-- ブラウザのタブに表示されるためのものでこのように記述すること検索で表示されやすいようにする --}}
    {{-- Bootstrap 5 の CSS を外部CDN から読み込む --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo img {
            height: 50px;
        }

        .nav-links a {
            margin-right: 15px;
            text-decoration: none;
            color: black;
        }

        .footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    {{-- ヘッダー --}}
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Blog Logo">
        </div>
        <h1>perfumuse</h1>
        <div class="nav-links">
            {{-- <a href="{{ route('home') }}">Home</a> --}}
            {{-- <a href="{{ route('posts.index') }}">投稿一覧</a>--}}
            {{--<a href="{{ route('about') }}">perfumuseについて</a>--}}
            <input type="text" placeholder="検索..." class="form-control d-inline-block w-25">
            {{-- <a href="{{ route('notifications') }}">通知</a> --}}
            {{-- <a href="{{ route('profile') }}">プロフィール（ログイン状態）</a> --}}
        </div>
    </header>

    <hr>

    <div class="container">
        <div class="row">
            {{-- カテゴリー一覧 --}}
            <div class="col-md-3">
                <h2>カテゴリー一覧</h2>
                <ul class="list-unstyled">
                    {{-- @foreach($categories as $category)
                    <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach --}}
                </ul>
            </div>

            {{-- 新着投稿 --}}
            <div class="new-posts">
                <h2>新着投稿</h2>
                <ul class="list-unstyled">
                    {{-- @foreach($recentPosts as $post)
                    <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
                    @endforeach --}}
                </ul>
                <a href="{{ route('categories.index') }}">[もっと見る]</a>
            </div>

            {{-- キュレーション --}}
            <div class="col-md-3">
                <h2>キュレーション</h2>
                <ul class="list-unstyled">
                    {{-- @foreach($curations as $curation)
                    <li><a href="{{ route('curations.show', $curation->id) }}">{{ $curation->title }}</a></li>
                    @endforeach --}}
                </ul>
            </div>
        </div>

        <hr>

        {{-- ランキング --}}
        <div>
            <h2>ランキング</h2>
            <ul class="list-unstyled">
                {{-- @foreach($ranking as $rank)
                <li><a href="{{ route('posts.show', $rank->id) }}">{{ $rank->title }}</a></li>
                @endforeach --}}
            </ul>
            {{-- <a href="{{ route('ranking') }}">[もっと見る]</a> --}}
        </div>

        <hr>

        {{-- フッター --}}
        <footer class="footer">
            <p>
                <a href="{{ route('about') }}">perfumuseについて</a> |
                <a href="{{ route('guides') }}">ガイド・ヘルプ</a> |
                <a href="{{ route('terms') }}">利用規約</a> |
                <a href="{{ route('privacy') }}">プライバシーポリシー</a> |
                <a href="{{ route('contact') }}">お問い合わせ</a>
            </p>
            <p>© 2025 perfumuse. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>