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

        $conversations = Conversation::with([
                'users'    => fn ($q) => $q->select('users.id', 'users.username'),
                'messages' => fn ($q) => $q->latest(),
            ])
            ->whereHas('users', fn ($q) => $q->where('users.id', $me->id))
            ->latest('updated_at')
            ->get();

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

        abort_unless($conversation->users()->where('users.id', $me->id)->exists(), 404);


    //  開いた人を既読に
        $conversation->users()->updateExistingPivot($me->id, ['last_read_at' => now()]);

        $conversations = Conversation::with([
                'users'    => fn ($q) => $q->select('users.id', 'users.username'),
                'messages' => fn ($q) => $q->latest(),
            ])
            ->whereHas('users', fn ($q) => $q->where('users.id', $me->id))
            ->latest('updated_at')
            ->get();

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

        // 保存
        $message = $conversation->messages()->create([
            'user_id' => $me->id,
            'body'    => $data['body'],
        ]);

        // 一覧の並び替えのため updated_at を更新
        $conversation->touch();

        $partnerId = $conversation->users()
            ->where('users.id','!=',$me->id)
            ->value('users.id');

        if ($partnerId) {
            broadcast(new \App\Events\MessageSent([
                'id'              => $message->id,
                'conversation_id' => $conversation->id,
                'from_user_id'    => $me->id,
                'from_username'   => $me->username ?? $me->name, // ★ 追加
                'body'            => $message->body,
                'sent_at'         => $message->created_at->toISOString(),
            ], (int)$partnerId))->toOthers();
        }

        return redirect()->route('dm.show', $conversation)->with('sent', true);
    }
    public function fetch(Request $request, Conversation $conversation)
    {
        $me = $request->user();
        abort_unless($conversation->users()->where('users.id',$me->id)->exists(), 404);

        $beforeId = (int) $request->query('before', 0); // このIDより古いもの
        $limit    = min(30, (int) $request->query('limit', 20));

        $q = $conversation->messages()
            ->with('user:id,username')
            ->orderByDesc('id');

        if ($beforeId > 0) {
            $q->where('id', '<', $beforeId);
        }

        // 返却は古い→新しい順にする（prepend しやすい）
        $chunk = $q->take($limit)->get()->sortBy('id')->values();

        return response()->json([
            'messages' => $chunk->map(fn($m) => [
                'id'        => $m->id,
                'user_id'   => $m->user_id,
                'username'  => $m->user?->username ?? 'ユーザー',
                'body'      => $m->body,
                'created_at'=> $m->created_at->toISOString(),
            ]),
            'done' => $chunk->count() < $limit,
        ]);
    }

}
