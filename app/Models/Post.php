<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'brand',
        'perfume_name',
        'image',
        'user_id',
    ];
    public function getByLimit(int $limit_count = 3)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    public function getPaginateByLimit(int $limit_count = 3)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
    // Post.php に追加されていない場合は必ず追加してください
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 現在のいいね数を取得（likeが存在している数＝解除されてないもの）
    public function getLikesCountAttribute()
    {
        return $this->likes()->count(); // `likes` テーブルが「現在のいいね」だけ持つならこれでOK
    }
}
