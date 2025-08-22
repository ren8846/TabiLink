<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // テーブルと主キー
    protected $table = 'profiles';
    protected $primaryKey = 'profile_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    // 保存可能カラム
    protected $fillable = [
        'users_id',
        'name',
        'gender',              // 'M' | 'F' | 'U'
        'self_introduction',
        'icon_path',
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
