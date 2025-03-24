@extends('layouts.app')

@section('content')
<h2>キュレーション一覧</h2>
<ul>
    @foreach($curations as $curation)
    <li><a href="#">{{ $curation->title }}</a></li>
    @endforeach
</ul>
@endsection