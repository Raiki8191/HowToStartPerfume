<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    // キュレーションが複数の投稿を持つ場合
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
