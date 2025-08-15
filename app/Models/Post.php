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
    ];
}
