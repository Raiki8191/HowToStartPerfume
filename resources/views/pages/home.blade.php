@extends('layouts.app')

@section('content')
<h2>カテゴリ一覧</h2>
<ul>
    @foreach($categories as $category)
    <li><a href="#">{{ $category->name }}</a></li>
    @endforeach
</ul>

<h2>キュレーション</h2>
<ul>
    @foreach($curations as $curation)
    <li><a href="#">{{ $curation->title }}</a></li>
    @endforeach
</ul>
@endsection