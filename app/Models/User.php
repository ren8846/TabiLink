<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'is_admin', 'notification'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
            'notification'      => 'boolean',
        ];
    }

    // ← ここから下は「クラスの中」に置く
    public function profile()
{
    return $this->hasOne(\App\Models\Profile::class, 'users_id', 'id');
}

public function posts()
{
    return $this->hasMany(\App\Models\Post::class, 'users_id', 'id');
}

}
