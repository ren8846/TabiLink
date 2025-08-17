@extends('layouts.app')
@section('title','Home')

@section('content')
  <div class="container my-3 main-has-bottom">
    {{-- 投稿エリアだけを書く --}}
    <div class="d-flex align-items-center mb-2">
      <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="user">
      <div>
        <strong>Helena</strong> in Group name <br>
        <small class="text-muted">3 min ago</small>
      </div>
    </div>

    <img src="https://via.placeholder.com/500x300" class="post-img mb-2" alt="post image">
    <p>Post description</p>
    <p class="fw-bold">保存</p>
    <i class="bi bi-heart fs-4"></i>
  </div>
@endsection
