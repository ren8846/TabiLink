<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'posts';

    // 主キー
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // 複数代入可能なカラム
    protected $fillable = [
        'post_id',
        'post_tag',
        'post_image',
        'post_content',
        'post_genre',
        'users_id',
        'post_title',
    ];

    // 投稿のユーザー（リレーション）
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // 投稿の画像（リレーション）
    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'post_id')
                    ->orderBy('sort_order');
    }
}