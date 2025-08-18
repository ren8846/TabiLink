@extends('layouts.app')
@section('title','DM')

@section('content')
<div class="container py-3">
  <h2 class="h5 mb-3">ダイレクトメッセージ</h2>

  <div class="row g-3">
    <!-- {{-- 左：会話一覧 --}} -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm">
        <div class="card-header py-2">
          <strong>会話一覧</strong>
        </div>
        <ul class="list-group list-group-flush" style="max-height: 70vh; overflow:auto;">
          @forelse($conversations as $c)
            @php
              $partner = $c->users->first(); 
              $last = optional($c->messages->first());
            @endphp
             <!-- 自分以外（Controllerでフィルタ済み） -->
            <a href="{{ route('dm.show', $c) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between {{ optional($active)->id === $c->id ? 'active text-white' : '' }}">
              <div class="me-2">
                <div class="fw-semibold">{{ $partner?->name ?? '（不明なユーザー）' }}</div>
                <small class="{{ optional($active)->id === $c->id ? 'text-white-50' : 'text-muted' }}">
                  {{ \Illuminate\Support\Str::limit($last?->body, 30) }}
                </small>
              </div>
              <small class="{{ optional($active)->id === $c->id ? 'text-white-50' : 'text-muted' }}">
                {{ $c->updated_at->diffForHumans() }}
              </small>
            </a>
          @empty
            <li class="list-group-item">会話はまだありません。</li>
          @endforelse
        </ul>
      </div>
    </div>

    <!-- {{-- 右：メッセージスレッド --}} -->
    <div class="col-12 col-md-8">
      <div class="card shadow-sm">
        <div class="card-header py-2 d-flex align-items-center justify-content-between">
          <div>
            @if($active)
              @php $partner = $active->partnerFor(auth()->id()); @endphp
              <strong>{{ $partner?->name ?? '会話' }}</strong>
              <small class="text-muted ms-2">#{{ $active->id }}</small>
            @else
              <strong>会話なし</strong>
            @endif
          </div>
        </div>

        <div id="thread" class="card-body bg-light" style="height: 55vh; overflow:auto;">
          @if(!$active)
            <div class="text-center text-muted mt-5">左の一覧から会話を選択してください。</div>
          @else
            @forelse($messages as $m)
              @php $mine = $m->user_id === auth()->id(); @endphp
              <div class="d-flex mb-2 {{ $mine ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="px-3 py-2 rounded-3 shadow-sm {{ $mine ? 'bg-primary text-white' : 'bg-white' }}"
                     style="max-width: 75%;">
                  <div class="small fw-semibold mb-1">
                    {{ $mine ? 'あなた' : $m->user->name }}
                    <span class="ms-2 small {{ $mine ? 'text-white-50' : 'text-muted' }}">{{ $m->created_at->format('Y/m/d H:i') }}</span>
                  </div>
                  <div style="white-space: pre-wrap;">{{ $m->body }}</div>
                </div>
              </div>
            @empty
              <div class="text-center text-muted">まだメッセージはありません。</div>
            @endforelse
          @endif
        </div>

        <!-- {{-- 送信フォーム --}} -->
        <div class="card-footer">
          @if($active)
            <form action="{{ route('dm.message.store', $active) }}" method="post" id="sendForm">
              @csrf
              <div class="input-group">
                <textarea name="body" class="form-control" rows="1" placeholder="メッセージを入力…" required></textarea>
                <button class="btn btn-primary" type="submit">送信</button>
              </div>
              @error('body')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  /* モバイルでの送信エリア固定感の調整 */
  #thread::-webkit-scrollbar { width: 8px; }
  #thread::-webkit-scrollbar-thumb { background-color: rgba(0,0,0,.15); border-radius: 4px; }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const thread = document.getElementById('thread');
    if (thread) {
      thread.scrollTop = thread.scrollHeight; // 下までスクロール
    }

    // 送信後にスピナー/連打防止（お好みで）
    const form = document.getElementById('sendForm');
    if (form) {
      form.addEventListener('submit', () => {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
          btn.disabled = true;
          btn.textContent = '送信中…';
        }
      });
    }
  });
</script>
@endpush
