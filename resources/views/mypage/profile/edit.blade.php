@extends('layouts.app')
@section('title','プロフィール')

@section('content')
<style>
  /* ===== mobile 見た目用の最小CSS ===== */
  .mobile-frame{max-width:420px;margin:0 auto;background:#fff;min-height:100vh}
  .mobile-header{display:flex;align-items:center;justify-content:space-between;height:56px;
    padding:0 12px;border-bottom:1px solid #eee;position:sticky;top:0;background:#fff;z-index:5}
  .mobile-header .title{font-weight:800;font-size:22px;letter-spacing:.02em}
  .back-btn{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;
    border-radius:9999px;text-decoration:none;color:#111}
  .avatar-wrap{display:flex;justify-content:center;margin:16px 0 12px}
  .avatar{width:96px;height:96px;border-radius:9999px;background:#e9ecef;overflow:hidden}
  .avatar img{width:100%;height:100%;object-fit:cover}

  .form-grid{display:grid;grid-template-columns:108px 1fr;gap:14px 12px;padding:6px 16px 18px}
  .form-grid .label{font-weight:700;color:#111;align-self:center}
  .form-grid input[type="text"],
  .form-grid textarea,
  .form-grid select{
    width:100%;border:1px solid #e5e7eb;border-radius:10px;padding:10px 12px;font-size:14px}
  .form-grid textarea{resize:vertical;min-height:96px}
  .gender-row{display:flex;gap:10px}
  .gender-row label{display:flex;align-items:center;gap:6px;
    border:1px solid #e5e7eb;border-radius:9999px;padding:8px 12px;cursor:pointer}
  .save-btn{display:block;width:92%;margin:10px auto 8px;background:#2563eb;color:#fff;
    border:none;border-radius:12px;padding:12px 14px;font-weight:700}

  .section-title{font-weight:800;margin:8px 16px}
  .post-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:0 16px 28px}
  .post-tile{aspect-ratio:1/1;border-radius:10px;background:#eee;overflow:hidden}
  .post-tile img{width:100%;height:100%;object-fit:cover;display:block}
</style>

<div class="mobile-frame">

  {{-- ヘッダー --}}
  <div class="mobile-header">
    <a href="{{ url()->previous() }}" class="back-btn" aria-label="戻る">‹</a>
    <div class="title">プロフィール</div>
    <div style="width:36px"></div>
  </div>

  {{-- アイコン（タップで画像選択が開く） --}}
<div class="avatar-wrap">
  <button type="button" id="pickIconBtn" class="avatar" style="cursor:pointer;border:none;padding:0;">
    <img id="iconPreview"
         src="{{ !empty($profile->icon_path ?? null) ? asset('storage/'.$profile->icon_path) : '' }}"
         alt="icon"
         style="width:100%;height:100%;object-fit:cover;{{ empty($profile->icon_path ?? null) ? 'display:none' : '' }}">
  </button>
  {{-- 隠しファイル入力：スマホならカメラ/ギャラリーが開く --}}
  <input id="iconInput" type="file" name="icon" accept="image/*" capture="environment" style="display:none;">
</div>


  {{-- 編集フォーム --}}
  <form action="{{ route('mypage.profile.update') }}" method="POST" class="mb-3" enctype="multipart/form-data">
    @csrf @method('PATCH')

    <div class="form-grid">
      <div class="label">名前</div>
      <div><input type="text" name="name" value="{{ old('name',$profile->name) }}" placeholder="山田 太郎"></div>

      <div class="label">ユーザーネーム</div>
      <div><input type="text" name="username" value="{{ old('username',$user->username) }}" placeholder="@taro"></div>

      <div class="label">性別</div>
      <div>
        @php $g = old('gender', $profile->gender ?? 'U'); @endphp
        <div class="gender-row">
          <label><input type="radio" name="gender" value="M" {{ $g==='M'?'checked':'' }}>男性</label>
          <label><input type="radio" name="gender" value="F" {{ $g==='F'?'checked':'' }}>女性</label>
          <label><input type="radio" name="gender" value="U" {{ $g==='U'?'checked':'' }}>未回答</label>
        </div>
      </div>

      <div class="label">自己PR</div>
      <div><textarea name="self_introduction" placeholder="自己紹介を入力">{{ old('self_introduction',$profile->self_introduction) }}</textarea></div>
    </div>

    <button class="save-btn">保存</button>

    @if ($errors->any())
      <ul class="text-danger small" style="padding:0 16px;">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    @endif
  </form>

  {{-- 投稿履歴 --}}
  <h6 class="section-title">投稿履歴</h6>
  <div class="post-grid">
    @forelse($posts as $post)
      <a class="post-tile" href="{{ route('posts.show', $post->post_id) ?? '#' }}">
        @if($post->post_image)
          <img src="{{ asset('storage/'.$post->post_image) }}" alt="">
        @endif
      </a>
    @empty
      <div style="grid-column:1/-1;color:#666;">まだ投稿がありません。</div>
    @endforelse
  </div>

  <div class="px-3 mb-4">{{ $posts->links() }}</div>
</div>

{{-- ===== 3秒で消えるバニラ版トースト（Bootstrap不要） ===== --}}
@if (session('status'))
<style>
  .toast-float {
    position: fixed;
    top: 12px;
    left: 50%;
    transform: translateX(-50%) translateY(-6px);
    background: #16a34a;       /* 緑 */
    color: #fff;
    padding: 10px 14px;
    border-radius: 12px;
    font-weight: 700;
    box-shadow: 0 8px 24px rgba(0,0,0,.18);
    z-index: 2000;
    opacity: 0;
    animation: toast-in .18s ease-out forwards, toast-out .2s ease-in 2.8s forwards;
    pointer-events: none;
  }
  @keyframes toast-in {
    to { opacity: 1; transform: translateX(-50%) translateY(0); }
  }
  @keyframes toast-out {
    to { opacity: 0; transform: translateX(-50%) translateY(-8px); }
  }
</style>
<div id="vtoast" class="toast-float" role="alert" aria-live="assertive" aria-atomic="true">
  {{ session('status') }}
</div>
<script>
  // 3.2秒後にDOMから削除
  setTimeout(() => {
    const t = document.getElementById('vtoast');
    if (t) t.remove();
  }, 3200);
</script>
@endif

<script>
(function () {
  const pickBtn = document.getElementById('pickIconBtn');
  const input   = document.getElementById('iconInput');
  const preview = document.getElementById('iconPreview');
  const form    = document.querySelector('form[action="{{ route('mypage.profile.update') }}"]');

  if (!pickBtn || !input || !form) return;

  // 丸アイコンをタップ → ファイル選択
  pickBtn.addEventListener('click', () => input.click());

  // 画像を選んだら即プレビュー＆自動送信
  input.addEventListener('change', () => {
    const file = input.files && input.files[0];
    if (!file) return;

    // プレビュー表示
    const reader = new FileReader();
    reader.onload = e => {
      if (preview) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      }
    };
    reader.readAsDataURL(file);

    // そのまま保存（コントローラでiconを受け取って保存する）
    form.submit();
  });
})();
</script>


@endsection
