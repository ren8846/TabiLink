@extends('layouts.app')
@section('title','検索')

<!-- {{-- チップ/カード用のCSS（layoutの <head> に @stack('styles') がある前提） --}} -->
@push('styles')
<style>
  .tags-scroller{display:flex;flex-wrap:nowrap;gap:.5rem;overflow:auto;padding-bottom:.25rem}
  .tags-scroller::-webkit-scrollbar{display:none}
  .chip{display:inline-flex;align-items:center;padding:.35rem .8rem;border:1px solid var(--bs-border-color);
        border-radius:9999px;background:#f8f9fa;color:#495057;text-decoration:none;font-size:.875rem;white-space:nowrap}
  .chip:hover{background:#e9ecef;text-decoration:none}
  .chip-active{background:#0d6efd;color:#fff;border-color:#0d6efd}
  .post-card{border:0;box-shadow:0 2px 10px rgba(0,0,0,.05)}
</style>
@endpush

@section('content')
<div class="container py-3">

  <!-- {{-- フォーム（GET） --}} -->
  <form id="searchForm" method="GET" action="{{ route('search.index') }}" class="d-flex align-items-center mb-3">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">
      <i class="bi bi-arrow-left"></i>
    </a>
    <input
      id="searchInput"
      type="text"
      name="q"
      value="{{ old('q', ($q ?? '') !== '' ? $q : ($tag ?? '')) }}"
      class="form-control me-2"
      placeholder="キーワードを入力">
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-search"></i>
    </button>
  </form>

  <!-- {{-- タグ（横スクロールのチップ） --}} -->
  <div class="tags-scroller mb-3">
    @foreach ($suggestTags as $t)
      <a href="{{ route('search.index', ['tag' => $t]) }}"
         class="chip js-tag {{ ($keyword ?? '') === $t ? 'chip-active' : '' }}"
         data-tag="{{ $t }}">
        {{ $t }}
      </a>
    @endforeach
    @if(($searched ?? false))
      <a href="{{ route('search.index') }}" class="chip">条件をクリア</a>
    @endif
  </div>

  <!-- {{-- 見出し or ガイド --}} -->
  @if($searched ?? false)
    <h5 class="mb-3">「{{ $keyword }}」の検索結果</h5>
  @else
    <p class="text-muted">タグをタップするか、キーワードを入力して検索してください。</p>
  @endif

  <!-- {{-- 結果一覧 --}} -->
  @if($searched ?? false)
    @if($posts && $posts->count())
      @foreach ($posts as $post)
        <div class="card post-card mb-3">
          <div class="card-body">
            <div class="mb-2 d-flex flex-wrap gap-2">
              @if(!empty($post->post_tag))
                <span class="badge bg-secondary">#{{ $post->post_tag }}</span>
              @endif
              @if(!empty($post->post_genre))
                <span class="badge bg-light text-muted">{{ $post->post_genre }}</span>
              @endif
            </div>

            <!-- {{-- ★ 追加：タイトル（本文の上に表示） --}} -->
            @if(!empty($post->post_title))
              <h3 class="h6 mb-1">{{ $post->post_title }}</h3>
            @endif

            @if(!empty($post->post_content))
              <p class="mb-2">{{ \Illuminate\Support\Str::limit($post->post_content, 160) }}</p>
            @endif

            <div class="d-flex justify-content-between text-muted small">
              <span>{{ optional($post->created_at)->format('Y/m/d H:i') }}</span>
              {{-- <a href="{{ route('posts.show',$post) }}" class="text-decoration-none">詳細</a> --}}
            </div>
          </div>
        </div>
      @endforeach
      <div class="mt-3">{{ $posts->links() }}</div>
    @else
      <p class="text-muted">該当する投稿がありません。</p>
    @endif
  @endif

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form  = document.getElementById('searchForm');
  const input = document.getElementById('searchInput');

  // タグ選択で自動送信するなら true（入力だけにしたいなら false）
  const autoSubmit = true;

  document.querySelectorAll('.js-tag').forEach(function (a) {
    a.addEventListener('click', function (e) {
      e.preventDefault();
      const word = a.dataset.tag || a.textContent.trim();

      // 置き換え（単一キーワード運用）
      input.value = word;

      // 追記したい場合（複数ワード）
      // const cur = input.value.trim();
      // input.value = cur ? (cur + ' ' + word) : word;

      if (autoSubmit && form) {
        if (form.requestSubmit) form.requestSubmit(); else form.submit();
      } else {
        input.focus();
      }
    });
  });
});
</script>
@endpush

