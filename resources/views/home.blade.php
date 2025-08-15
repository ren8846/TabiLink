{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabiLink</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .navbar {
            border-bottom: 1px solid #ddd;
        }
        .post-img {
            width: 100%;
            border-radius: 8px;
        }
        .bottom-nav {
            border-top: 1px solid #ddd;
            background: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .bottom-nav .nav-link {
            padding: 8px 0;
            font-size: 20px;
            color: #555;
        }
        .bottom-nav .nav-link.active {
            color: #000;
        }
    </style>
</head>
<body>

<!-- 上部ナビ -->
<nav class="navbar bg-white px-3">
    <a href="{{ route('map') }}" class="me-auto"><i class="bi bi-geo-alt fs-4"></i></a>
    <span class="mx-auto fw-bold fs-5">TabiLink</span>
    <a href="#"><i class="bi bi-send fs-4"></i></a>
</nav>

<!-- 投稿エリア -->
<div class="container my-3" style="padding-bottom: 60px;">
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

<!-- 下部ナビ -->
<nav class="nav justify-content-around bottom-nav">
    <a class="nav-link active" href="{{ route('home') }}"><i class="bi bi-house"></i></a>
    <a class="nav-link" href="{{ route('search') }}"><i class="bi bi-search"></i></a>
    <a class="nav-link" href="{{ route('post.create') }}"><i class="bi bi-plus-square"></i></a>
    <a class="nav-link" href="{{ route('board') }}"><i class="bi bi-chat-dots"></i></a>
    <a class="nav-link" href="{{ route('mypage') }}"><i class="bi bi-person"></i></a>
</nav>

</body>
</html>