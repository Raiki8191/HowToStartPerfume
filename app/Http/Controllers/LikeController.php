<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LikedPostNotification;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $user = auth()->user();

        if ($user->likedPosts()->where('post_id', $post->id)->exists()) {
            // 既にいいねしていたら解除
            $user->likedPosts()->detach($post->id);
        } else {
            // まだなら付与＋通知
            $user->likedPosts()->attach($post->id);
            $post->user->notify(new LikedPostNotification($user, $post));
        }

        // いいね数を再取得して表示する場合に更新
        $post->loadCount('likes');  // 投稿に関連する「いいね数」を更新

        return back();
    }
}
