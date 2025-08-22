<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'posts__images'; // ←いま作ったテーブル名に合わせる
    protected $fillable = ['post_id', 'path', 'caption', 'sort_order'];
    public $timestamps = true;
}
