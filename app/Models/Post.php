<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // テーブル名（単数形じゃなく複数形を指定）
    protected $table = 'posts';

    // 主キーが 'id' 以外なので指定
    protected $primaryKey = 'post_id';

    // 主キーが自動採番なので incrementing を true（デフォルト）
    public $incrementing = true;

    // 主キーが整数型なので string ではない
    protected $keyType = 'int';

    // 複数代入を許可するカラム
    protected $fillable = [
        'post_id',
        'post_tag',
        'post_image',
        'post_content',
        'post_genre',
        'users_id',
        'post_title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\PostImage::class, 'post_id', 'post_id')
                    ->orderBy('sort_order');
    }


}

use App\Models\Post;
use App\Models\PostImage;

$post = Post::latest('post_id')->first();
$post->post_id;

PostImage::where('post_id', $post->post_id)->pluck('path', 'id');

Post::with('images')->find($post->post_id)->images->pluck('path','id');