<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <footer class="footer">
            <p>
                <!-- <a href="{{ route('about') }}">perfumuseについて</a> |
                <a href="{{ route('guides') }}">ガイド・ヘルプ</a> |
                <a href="{{ route('terms') }}">利用規約</a> |
                <a href="{{ route('privacy') }}">プライバシーポリシー</a> |
                <a href="{{ route('contact') }}">お問い合わせ</a> -->
                (開発中)perfumuseについて |
                ガイド・ヘルプ |
                利用規約 |
                プライバシーポリシー |
                お問い合わせ
            </p>
            <p>© 2025 perfumuse. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>