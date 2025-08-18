@extends('layouts.app')
@section('title','Home')

@section('content')
  <div class="max-w-xl mx-auto p-4 lg:p-6">
    <!-- {{-- ユーザー情報風のヘッダー行 --}} -->
    <div class="flex items-center gap-3 mb-3">
      <img src="https://via.placeholder.com/40" class="h-10 w-10 rounded-full object-cover" alt="user">
      <div>
        <strong class="block text-gray-900">Helena</strong>
        <span class="text-sm text-gray-500">in Group name ・ 3 min ago</span>
      </div>
    </div>

    <!-- {{-- 投稿画像 --}} -->
    <img src="https://via.placeholder.com/800x480" class="w-full rounded-lg mb-3" alt="post image">

    <!-- {{-- 本文 --}} -->
    <p class="text-gray-800 mb-2">Post description</p>

    <!-- {{-- アクション行 --}} -->
    <div class="flex items-center justify-between">
      <button type="button" class="text-gray-600 hover:text-gray-800 transition">
        <!-- ハート（Heroicons等でもOK。とりあえず文字で） -->
        ♥
      </button>
      <button class="font-semibold text-blue-600 hover:text-blue-700">保存</button>
    </div>
  </div>
@endsection
