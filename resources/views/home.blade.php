@extends('layouts.app')
@section('title','Home')

@section('content')@section('content')
<div class="mx-auto max-w-[420px] bg-white min-h-screen">

  <!-- {{-- 上部バー --}}
  <div class="sticky top-0 z-10 bg-white/95 backdrop-blur border-b">
    <div class="h-12 flex items-center justify-between px-3">
      <button class="text-xl" aria-label="location">🌐</button>
      <h1 class="font-extrabold text-lg">TabiLink</h1>
      <button class="text-xl" aria-label="dm">✈️</button>
    </div>
  </div> -->

  {{-- 投稿一覧 --}}
  @forelse($posts as $post)
    <article class="border-b-8 border-gray-100">
      {{-- ヘッダー行（ユーザー情報） --}}
      <div class="flex items-center gap-3 px-3 py-3">
        <img
          src="{{ optional($post->user->profile)->icon_path ? asset('storage/'.$post->user->profile->icon_path) : 'https://via.placeholder.com/40' }}"
          class="w-10 h-10 rounded-full object-cover" alt="user">
        <div>
          <strong class="block text-gray-900">
            {{ $post->user->username ?? $post->user->name ?? 'User' }}
          </strong>
          <span class="text-sm text-gray-500">
            {{ optional($post->created_at)->diffForHumans() }} ・ {{ $post->group_name ?? 'Group name' }}
          </span>
        </div>
        <button class="ml-auto text-xl" aria-label="share">➤</button>
      </div>

      {{-- 仕切り（or） --}}
      <div class="relative text-center mx-3 my-1 text-gray-300 text-xs">
        <span class="relative z-10 px-2 bg-white">or</span>
        <span class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-px bg-gray-200"></span>
      </div>

      {{-- 画像 --}}
      <div>
        @if(!empty($post->post_image))
          <img src="{{ asset('storage/'.$post->post_image) }}" alt="post image"
               class="w-full aspect-square object-cover">
        @else
          <img src="https://via.placeholder.com/800x800?text=No+Image"
               class="w-full aspect-square object-cover" alt="">
        @endif
      </div>

      {{-- 本文＆アクション --}}
      <div class="px-3 py-2">
        <p class="text-gray-800 mb-2">{{ $post->post_content ?? 'Post description' }}</p>
        <div class="flex items-center justify-between">
          <button type="button" class="text-2xl leading-none select-none" aria-label="like">♡</button>
          {{-- 保存APIがまだなら type="button" のままでOK --}}
          <button type="button" class="bg-black text-white rounded-md px-3 py-1 font-semibold text-sm">保存</button>
        </div>
      </div>
    </article>
  @empty
    <div class="py-6 text-center text-gray-500">まだ投稿がありません。</div>
  @endforelse

  <div class="px-3 py-3">{{ $posts->links() }}</div>
</div>
@endsection

