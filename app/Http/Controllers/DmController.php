<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;

class DMController extends Controller
{
    // DM一覧（左ペイン）
    public function index(Request $request)
    {
        $me = $request->user();

        // 自分が参加している会話一覧（最新更新順）
        $conversations = Conversation::with([
                'users'    => fn ($q) => $q->select('users.id', 'users.username'),
                'messages' => fn ($q) => $q->latest(),
            ])
            ->whereHas('users', fn ($q) => $q->where('users.id', $me->id))
            ->latest('updated_at')
            ->get();

        // 右ペインは未選択の状態
        return view('dm', [
            'conversations' => $conversations,
            'active'        => null,
            'messages'      => collect(),
        ]);
    }

    // 会話詳細（右ペイン）
    public function show(Request $request, Conversation $conversation)
    {
        $me = $request->user();

        // 自分が会話の参加者でなければ404
        abort_unless($conversation->users()->where('users.id', $me->id)->exists(), 404);

        // 左ペイン用：一覧も毎回渡す（更新順）
        $conversations = Conversation::with([
                'users'    => fn ($q) => $q->select('users.id', 'users.username'),
                'messages' => fn ($q) => $q->latest(),
            ])
            ->whereHas('users', fn ($q) => $q->where('users.id', $me->id))
            ->latest('updated_at')
            ->get();

        // 右ペイン用：対象会話のメッセージ（古い→新しい）
        $messages = $conversation->messages()
            ->with('user:id,username')
            ->orderBy('created_at')
            ->get();

        return view('dm', [
            'conversations' => $conversations,
            'active'        => $conversation,
            'messages'      => $messages,
        ]);
    }

    // メッセージ送信
    public function store(Request $request, Conversation $conversation)
    {
        $me = $request->user();

        // 参加者チェック
        abort_unless($conversation->users()->where('users.id', $me->id)->exists(), 404);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->user_id = $me->id;
        $message->body = $data['body'];
        $message->save();

        // 一覧の並び替えのため updated_at を更新
        $conversation->touch();

        // （任意）リアルタイム配信するならイベントを発火
        foreach ($recipientIds as $toUserId) {
            broadcast(new MessageSent([
                'id'              => $message->id,
                'conversation_id' => $conversation->id,
                'from_user_id'    => auth()->id(),
                'body'            => $message->body,
                'sent_at'         => $message->created_at->toISOString(),
            ], (int)$toUserId))->toOthers();
        }

        return redirect()->route('dm.show', $conversation)->with('sent', true);
    }
}
