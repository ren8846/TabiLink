@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
<div class="max-w-3xl mx-auto p-4">
  <h2 class="text-lg font-semibold mb-4">マイページ</h2>

  <div class="bg-white rounded-lg shadow p-4 space-y-3">
    <div class="flex items-center gap-3">
      <i class="bi bi-person-circle text-3xl"></i>
      <div>
        <div class="font-medium">{{ auth()->user()->username ?? auth()->user()->name }}</div>
        <div class="text-gray-500 text-sm">{{ auth()->user()->email }}</div>
      </div>
    </div>

    <div class="pt-3 border-t">
      <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
        <i class="bi bi-gear"></i> プロフィール編集へ
      </a>
    </div>
  </div>
</div>
@endsection
