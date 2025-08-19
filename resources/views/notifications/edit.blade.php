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

    <label class="inline-flex items-center gap-2 mb-4">
    <input type="checkbox" name="notify_enabled" value="1"
            @checked(old('notify_enabled', $user->notify_enabled ?? false))>
    通知を受け取る
    </label>

    <button class="px-4 py-2 rounded bg-blue-600 text-white">保存</button>
</form>
</div>
@endsection

</div>
