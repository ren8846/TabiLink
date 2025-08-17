<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← これが正解
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail; // メール認証を使うなら有効化

class User extends Authenticatable // implements MustVerifyEmail
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
}
