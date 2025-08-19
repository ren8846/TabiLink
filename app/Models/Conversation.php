<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    // 参加ユーザー（中間テーブル名は実装に合わせて修正）
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Bladeの $active->partnerFor(auth()->id()) で使う相手ユーザー取得
    public function partnerFor(int $myId)
    {
        return $this->users()->where('users.id', '!=', $myId)->first();
    }
}
