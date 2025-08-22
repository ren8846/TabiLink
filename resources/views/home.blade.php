@extends('layouts.app')
@section('title','ホーム')

@section('content')
<div class="max-w-2xl mx-auto p-4 lg:p-6">
  <h2 class="text-lg font-semibold mb-4">最新の投稿</h2>

  @forelse ($posts as $post)
    <article class="rounded-2xl border border-gray-200 bg-white shadow-sm p-4 mb-4">
      <!-- {{-- タグ/ジャンル --}} -->
      <div class="flex items-center gap-2 mb-3">
        @if(!empty($post->post_tag))
          <span class="inline-flex items-center px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-700">
            #{{ $post->post_tag }}
          </span>
        @endif
        @if(!empty($post->post_genre))
          <span class="inline-flex items-center px-2 py-0.5 text-xs rounded-full bg-blue-50 text-blue-700">
            {{ $post->post_genre }}
          </span>
        @endif
      </div>

      <!-- {{-- タイトル（本文は表示しない） --}} -->
      @if(!empty($post->post_title))
        <h3 class="text-base font-semibold text-gray-900 mb-2">{{ $post->post_title }}</h3>
      @endif

      <!-- {{-- 画像ギャラリー（posts__images優先／URLエンコード対応） --}} -->
      @php
          $imgs = $post->images ?? collect();  // nullの場合は空コレクション
      @endphp

      @if($imgs->count() > 0)
        <div class="grid grid-cols-3 gap-2 mb-3">
          @foreach($imgs as $img)
            @php
              $src = $img->path;
              $isUrl = \Illuminate\Support\Str::startsWith($src, ['http://','https://']);
              if (!$isUrl) {
                $segments = array_map('rawurlencode', explode('/', ltrim($src, '/')));
                $src = asset(implode('/', $segments));
              }
            @endphp
            <img
              src="{{ $src }}"
              class="w-full rounded-lg object-cover"
              style="aspect-ratio:1/1"
              alt="post image"
              loading="lazy"
              onerror="this.remove()"
            >
          @endforeach
        </div>
      @elseif(!empty($post->post_image))
        @php
          $src = $post->post_image;
          $isUrl = \Illuminate\Support\Str::startsWith($src, ['http://','https://']);
          if (!$isUrl) {
            $segments = array_map('rawurlencode', explode('/', ltrim($src, '/')));
            $src = asset(implode('/', $segments));
          }
        @endphp
        <img
          src="{{ $src }}"
          class="w-full rounded-xl mb-3 object-cover"
          alt="post image"
          loading="lazy"
          onerror="this.remove()"
        >
      @endif

      <!-- {{-- アクション行 --}} -->
      <div class="flex items-center justify-between text-sm text-gray-500">
        <span>{{ optional($post->created_at)->format('Y/m/d H:i') }}</span>
        <div class="flex items-center gap-4">
          <button type="button" class="text-gray-600 hover:text-gray-800 transition">♥</button>
          <button class="font-semibold text-blue-600 hover:text-blue-700">保存</button>
        </div>
      </div>
    </article>
  @empty
    <p class="text-gray-500">まだ投稿がありません。</p>
  @endforelse

  <div class="mt-4">
    {{ $posts->links() }}
  </div>
</div>
@endsection
