@extends('layouts.app')

@section('content')
<h2>カテゴリ一覧</h2>
<ul>
    @foreach($categories as $category)
    <li><a href="#">{{ $category->name }}</a></li>
    @endforeach
</ul>
@endsection