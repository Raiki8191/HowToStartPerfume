<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // 未読通知を既読に更新
        auth()->user()->unreadNotifications->markAsRead();

        $notifications = Auth::user()->notifications; // 全通知
        return view('notifications.index', compact('notifications'));
    }
}


// public function index()
// {
//     // 未読通知を既読に更新
//     auth()->user()->unreadNotifications->markAsRead();

//     // 通知一覧を取得（ページネーションなども可）
//     $notifications = auth()->user()->notifications()

//     return view('notifications.index', compact('notifications'));
// }