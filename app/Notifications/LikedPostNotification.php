<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikedPostNotification extends Notification
{
    use Queueable;

    protected User $liker;
    protected Post $post;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $liker, Post $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'message' => "{$this->liker->name}さんがあなたの投稿「{$this->post->title}」にいいねしました。",
        ];
    }
    public function toDatabase($notifiable)
    {
        return [
            'id' => Str::uuid(),
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'message' => "{$this->liker->name} さんがあなたの投稿「{$this->post->title}」にいいねしました。",
            'read_status' => 0,  // 未読で初期化
        ];
    }
}
