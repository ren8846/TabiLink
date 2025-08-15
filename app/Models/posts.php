<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','body']; // マイグレーションのカラム名と一致させる
    // テーブルに timestamps が無いなら:
    // public $timestamps = false;
}