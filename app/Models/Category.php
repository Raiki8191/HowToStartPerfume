<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // カテゴリが複数の投稿を持つ場合
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
