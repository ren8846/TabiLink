<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 主キーが post_id なら必須
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'post_tag','post_image','post_content','post_genre','users_id'
    ];

    public function user()
    {
        // 外部キーが users_id なので指定
        return $this->belongsTo(User::class, 'users_id');
    }
}
