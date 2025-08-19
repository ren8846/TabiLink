<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    // 参加ユーザー（中間テーブル名は実装に合わせて修正）
    public function users() {
        return $this->belongsToMany(\App\Models\User::class)
        ->withTimestamps()
        ->withPivot('last_read_at');      // ★ 追加
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
    
    public static function unreadTotalFor(int $userId): int {
        // 二者間DM前提：各会話で「相手の最新メッセージ時刻」と自分の last_read_at を比較
        $convs = static::whereHas('users', fn($q) => $q->where('users.id', $userId))
            ->with(['users' => fn($q) => $q->where('users.id', $userId)])
            ->get();

        $total = 0;
        foreach ($convs as $c) {
            $lastRead = optional($c->users->first()?->pivot)->last_read_at;
            $lastOther = \App\Models\Message::where('conversation_id', $c->id)
                ->where('user_id', '!=', $userId)
                ->latest('created_at')
                ->value('created_at');
            if ($lastOther && (!$lastRead || $lastOther > $lastRead)) {
                $total++;
            }
        }
        return $total; // 会話単位の未読数（件数）。数メッセージ単位にしたいなら sum に変更
    }

    // Bladeの $active->partnerFor(auth()->id()) で使う相手ユーザー取得
    public function partnerFor(int $myId) {
        return $this->users()->where('users.id', '!=', $myId)->first();
    }
}
