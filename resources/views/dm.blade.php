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
          @forelse(($conversations ?? []) as $c)
            @php
              $partner = $c->users->firstwhere('id','!=', auth()->id()); 
              $last = optional($c->messages->first());
            @endphp
             <!-- 自分以外（Controllerでフィルタ済み） -->
            <a href="{{ route('dm.show', $c) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between {{ optional($active)->id === $c->id ? 'active text-white' : '' }}">
              <div class="me-2">
                <div class="fw-semibold">{{ $partner?->username ?? '（不明なユーザー）' }}</div>
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
              <strong>{{ $partner?->username ?? '会話' }}</strong>
              <small class="text-muted ms-2">#{{ $active->id }}</small>
            @else
              <strong>会話なし</strong>
            @endif
          </div>
        </div>

        <div id="thread" class="card-body" style="height: 55vh; overflow:auto;">
          @if(!$active)
            <div class="text-center text-muted mt-5">左の一覧から会話を選択してください。</div>
          @else
            @forelse($messages as $m)
              @php $mine = $m->user_id === auth()->id(); @endphp
              <div class="d-flex mb-2 {{ $mine ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="px-3 py-2 rounded-3 {{ $mine ? 'dm-bubble-out' : 'dm-bubble-in' }}"
                     style="max-width: 75%;">
                  <div class="small fw-semibold mb-1">
                    {{ $mine ? 'あなた' : $m->user->username }}
                    <span class="ms-2 small {{ $mine ? 'text-white-50' : 'text-secondary' }}">{{ $m->created_at->format('Y/m/d H:i') }}</span>
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
  .dm-thread { background:#eef2f7; }
  .dm-bubble-in{
    background:#fff; color:#111827;
    border:2px solid #d1d5db; box-shadow:0 1px 2px rgba(0,0,0,.06);
  }
  .dm-bubble-out{
    background:#2563eb; color:#fff;
    box-shadow:0 2px 4px rgba(37,99,235,.35);
  }
  .list-group-item{ background:#fff; }
  .dm-flash{ animation: dmFlash 700ms ease-out 1; }
  @keyframes dmFlash{
    0%{ box-shadow:0 0 0 0 rgba(37,99,235,.35); }
    100%{ box-shadow:0 0 0 12px rgba(37,99,235,0); }
  }
</style>
@endpush

@push('scripts')
<script>
  // ===== Blade から埋め込む値 =====
  const meId    = @json(auth()->id());
  const convId  = @json(optional($active)->id);                     // 会話ID（一覧画面では null）
  let   oldestId= @json(optional($messages->first())->id);          // 画面にある最古メッセージID（昇順表示前提）
  const csrf    = document.querySelector('meta[name="csrf-token"]')?.content;

  // ===== 共通ユーティリティ =====
  const esc = (s) => (s || '').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const fmt = (d) => `${d.getFullYear()}/${String(d.getMonth()+1).padStart(2,'0')}/${String(d.getDate()).padStart(2,'0')} ${String(d.getHours()).toString().padStart(2,'0')}:${String(d.getMinutes()).toString().padStart(2,'0')}`;

  // ===== 受信：相手の新着をDOMに追加（リロードなし） =====
  function appendIncoming(e){
    const thread = document.getElementById('thread');
    if(!thread) return;

    const wrap = document.createElement('div');
    wrap.className = 'd-flex mb-2 justify-content-start';

    const d  = e?.sent_at ? new Date(e.sent_at) : new Date();
    const ts = fmt(d);

    wrap.innerHTML = `
      <div class="px-3 py-2 rounded-3 dm-bubble-in dm-flash" style="max-width:75%;">
        <div class="small fw-semibold mb-1">
          ${esc(e?.from_username || '相手')}
          <span class="ms-2 small text-secondary">${ts}</span>
        </div>
        <div style="white-space: pre-wrap;">${esc(e?.body)}</div>
      </div>
    `;
    thread.appendChild(wrap);
    thread.scrollTop = thread.scrollHeight;
  }

  // ===== 送信：楽観描画＋AJAX =====
  async function sendOptimistic(e) {
    e.preventDefault();
    const form = e.currentTarget;
    const textarea = form.querySelector('textarea[name="body"]');
    const btn = form.querySelector('button[type="submit"]');
    const raw = textarea.value;
    const body = (raw || '').trim();
    if (!body) return;

    // 1) 先に自分のバブルを描画（pending）
    const thread = document.getElementById('thread');
    const wrap = document.createElement('div');
    wrap.className = 'd-flex mb-2 justify-content-end';
    const now = new Date();
    wrap.innerHTML = `
      <div class="px-3 py-2 rounded-3 dm-bubble-out" style="max-width:75%; opacity:.85" data-pending="1">
        <div class="small fw-semibold mb-1">
          あなた <span class="ms-2 small text-white-50">${fmt(now)}</span>
        </div>
        <div style="white-space:pre-wrap;">${esc(raw)}</div>
      </div>`;
    thread.appendChild(wrap);
    thread.scrollTop = thread.scrollHeight;

    // 2) サーバへ送信（JSONで受ける）
    btn.disabled = true; btn.textContent = '送信中…';
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
        },
        body: new FormData(form),
      });
      if (!res.ok) throw new Error('send failed');
      const json = await res.json();

      // 3) pending解除（確定タイムスタンプを反映）
      const bubble = thread.querySelector('[data-pending="1"]');
      if (bubble) {
        bubble.style.opacity = '1';
        bubble.removeAttribute('data-pending');
        const timeEl = bubble.querySelector('.small span');
        if (timeEl && json?.sent_at) {
          timeEl.textContent = fmt(new Date(json.sent_at));
        }
      }
      textarea.value = '';
    } catch (err) {
      // エラー時は赤枠でフィードバック
      const bubble = thread.querySelector('[data-pending="1"]');
      if (bubble) { bubble.classList.add('border','border-3','border-danger'); bubble.style.opacity = '.9'; }
      alert('送信に失敗しました。ネットワークを確認してください。');
    } finally {
      btn.disabled = false; btn.textContent = '送信';
    }
  }

  // ===== 無限スクロール：先頭で読み足す =====
  let loadingOld = false;
  let reachEnd   = false;

  async function loadOlder() {
    if (!convId || loadingOld || reachEnd || !oldestId) return;
    loadingOld = true;

    const thread = document.getElementById('thread');
    const beforeHeight = thread.scrollHeight;

    try {
      const res = await fetch(`{{ url('/dm') }}/${convId}/messages?before=${oldestId}&limit=20`, {
        headers: { 'Accept':'application/json' }
      });
      if (!res.ok) throw new Error('fetch failed');
      const json = await res.json();

      const frag = document.createDocumentFragment();
      (json.messages || []).forEach(m => {
        const wrap = document.createElement('div');
        const mine = Number(m.user_id) === Number(meId);
        wrap.className = `d-flex mb-2 ${mine ? 'justify-content-end' : 'justify-content-start'}`;
        wrap.innerHTML = `
          <div class="px-3 py-2 rounded-3 ${mine ? 'dm-bubble-out' : 'dm-bubble-in'}" style="max-width:75%;">
            <div class="small fw-semibold mb-1">
              ${mine ? 'あなた' : esc(m.username || '相手')}
              <span class="ms-2 small ${mine ? 'text-white-50' : 'text-secondary'}">
                ${fmt(new Date(m.created_at))}
              </span>
            </div>
            <div style="white-space:pre-wrap;">${esc(m.body||'')}</div>
          </div>`;
        frag.appendChild(wrap);
      });

      if (json.messages?.length) {
        oldestId = json.messages[0].id;         // さらに古い境界を更新
        thread.prepend(frag);
        // スクロール位置を維持
        thread.scrollTop = thread.scrollHeight - beforeHeight;
      } else {
        reachEnd = true; // もう過去無し
      }
    } catch (e) {
      console.error(e);
    } finally {
      loadingOld = false;
    }
  }

  // ===== 初期化 =====
  document.addEventListener('DOMContentLoaded', () => {
    // Echo購読（window.Echo は resources/js/echo.js で初期化済み想定）
    if (window.Echo && meId) {
      window.Echo.private(`dm.${meId}`)
        .listen('.MessageSent', (e) => appendIncoming(e));
    }

    // 最下部へスクロール
    const thread = document.getElementById('thread');
    if (thread) {
      thread.scrollTop = thread.scrollHeight;

      // 会話表示中のみ：上端付近で過去ログを追加ロード
      if (convId && oldestId) {
        thread.addEventListener('scroll', () => {
          if (thread.scrollTop <= 60) loadOlder();
        });
      }
    }

    // フォーム送信をAJAXに差し替え
    const form = document.getElementById('sendForm');
    if (form) form.addEventListener('submit', sendOptimistic);
  });
</script>
@endpush

