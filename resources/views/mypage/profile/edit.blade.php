@extends('layouts.app')

@section('content')
<div class="container py-3" style="max-width: 640px;">
    {{-- 戻る --}}
    <div class="mb-3">
        <a href="{{ route('mypage') ?? url('/mypage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>

    <h2 class="fw-bold mb-4">プロフィール</h2>

    {{-- アイコン --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-circle overflow-hidden" style="width:96px;height:96px;background:#eee;">
            @if($user->icon_path)
                <img src="{{ asset('storage/'.$user->icon_path) }}" alt="icon" class="w-100 h-100 object-fit-cover">
            @endif
        </div>
        <form action="{{ route('mypage.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <input type="file" name="icon" class="form-control form-control-sm" accept="image/*">
            <button class="btn btn-sm btn-primary mt-2">アイコンを変更</button>
        </form>
    </div>

    {{-- 基本情報フォーム --}}
    <form action="{{ route('mypage.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

        <div class="mb-3">
            <label class="form-label fw-bold">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}">
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">ユーザーネーム</label>
            <input type="text" name="username" class="form-control" value="{{ old('username',$user->username) }}" placeholder="@haruka">
            @error('username')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold d-block">性別</label>
            @php $g = old('gender',$user->gender ?? 'unspecified'); @endphp
            <div class="btn-group" role="group">
                <input class="btn-check" type="radio" name="gender" id="g_m" value="male" {{ $g==='male'?'checked':'' }}>
                <label class="btn btn-outline-secondary" for="g_m">男性</label>

                <input class="btn-check" type="radio" name="gender" id="g_f" value="female" {{ $g==='female'?'checked':'' }}>
                <label class="btn btn-outline-secondary" for="g_f">女性</label>

                <input class="btn-check" type="radio" name="gender" id="g_u" value="unspecified" {{ $g==='unspecified'?'checked':'' }}>
                <label class="btn btn-outline-secondary" for="g_u">未回答</label>
            </div>
            @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">自己PR</label>
            <textarea name="bio" rows="4" class="form-control" placeholder="自己紹介を書いてください">{{ old('bio',$user->bio) }}</textarea>
            @error('bio')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <button class="btn btn-primary w-100">保存</button>
        @if(session('status'))<div class="alert alert-success mt-3">{{ session('status') }}</div>@endif
    </form>

    {{-- 投稿履歴 --}}
    <h5 class="fw-bold mb-3">投稿履歴</h5>
    @if($posts->count())
        <div class="row g-2">
            @foreach($posts as $post)
                <div class="col-4">
                    <a href="{{ route('posts.show', $post->post_id) ?? '#' }}" class="d-block ratio ratio-1x1 bg-light rounded">
                        @if($post->post_image)
                            <img src="{{ asset('storage/'.$post->post_image) }}" alt="" class="w-100 h-100 object-fit-cover rounded">
                        @else
                            <div class="w-100 h-100 rounded" style="background:#e9ecef;"></div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-3">{{ $posts->links() }}</div>
    @else
        <div class="text-muted">まだ投稿がありません。</div>
    @endif
</div>
@endsection
