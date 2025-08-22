@extends('layouts.app') {{-- レイアウトはプロジェクトに合わせて変更 --}}

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <h4 class="mb-3">ログアウトしますか？</h4>
    <p class="text-muted mb-4">3秒後に自動でログアウトします。今すぐログアウトすることもできます。</p>

    {{-- 今すぐログアウト --}}
    <form id="logoutForm" method="POST" action="{{ route('logout.perform') }}">
        @csrf
        <button type="submit" class="btn btn-danger w-100 mb-3">今すぐログアウト</button>
    </form>

    {{-- キャンセル --}}
    <a href="{{ route('mypage') }}" class="btn btn-outline-secondary">キャンセル</a>

</div>

<!-- {{-- 3秒後に自動ログアウト --}}
<script>
    setTimeout(() => {
        document.getElementById('logoutForm').submit();
    }, 3000);
</script> -->
@endsection
