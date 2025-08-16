<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DmController extends Controller
{
   public function index(Request $request){
    $user = auth()->user();

    $conversations = $user->conversations()
        ->with(['users' => fn($q) => $q->where('users.id', '!=', $user->id)])
        ->with(['messages' => fn($q) => $q->latest()->limit(1)])
        ->latest('conversations.updated_at')
        ->get();

    $active = $conversations->first();

    $messages = $active
        ? \App\Models\Message::with('user')
            ->where('conversation_id', $active->id)
            ->latest()
            ->take(50)
            ->get()->reverse()
        : collect();

    // ★ここが重要：view に3つ渡す
    return view('dm', [
        'conversations' => $conversations,
        'active'        => $active,
        'messages'      => $messages,
    ]);
}

public function show(\App\Models\Conversation $conversation)
{
    $this->authorizeAccess($conversation);

    $user = auth()->user();

    $conversations = $user->conversations()
        ->with(['users' => fn($q) => $q->where('users.id', '!=', $user->id)])
        ->with(['messages' => fn($q) => $q->latest()->limit(1)])
        ->latest('conversations.updated_at')
        ->get();

    $messages = \App\Models\Message::with('user')
        ->where('conversation_id', $conversation->id)
        ->latest()
        ->take(100)
        ->get()->reverse();

    return view('dm', [
        'conversations' => $conversations,
        'active'        => $conversation,
        'messages'      => $messages,
    ]);
   } // 
}
