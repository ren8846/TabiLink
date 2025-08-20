<div>
    {{-- resources/views/notifications/edit.blade.php --}}
@extends('layouts.app')
@section('title','通知設定')

@section('content')
<div class="max-w-md mx-auto p-4">
  <h1 class="text-lg font-bold mb-4">通知設定</h1>

  @if (session('status'))
    <div class="mb-3 text-green-700">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('mypage.notifications.update') }}">
  @csrf
  @method('PATCH')
  <label class="form-check form-switch">
    <input type="checkbox" class="form-check-input" name="notify_enabled" {{ auth()->user()->notify_enabled ? 'checked' : '' }}>
    通知を有効にする
  </label>
  <button class="btn btn-primary mt-3">更新</button>
</form>

</div>
@endsection

</div>