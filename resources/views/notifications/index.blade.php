{{-- resources/views/notifications/index.blade.php --}}
@extends('layouts.app') {{-- Breezeなど使っているならこれでOK --}}

@section('content')
<div class="container">
    <h2>通知一覧</h2>

    @if ($notifications->isEmpty())
    <p>通知はありません。</p>
    @else
    <ul class="list-group">
        @foreach ($notifications as $notification)
        <li class="list-group-item">
            {{ $notification->data['message'] ?? '通知メッセージが見つかりません' }}
            <br>
            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection