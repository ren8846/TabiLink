<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿ページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .image-preview {
            width: 100%;
            max-width: 300px;
            height: 300px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 10px auto;
            background-color: #f8f9fa;
        }
        .image-preview img {
            width: 100%;
            height: auto;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
    {{-- 上部バー --}}
    <div class="top-bar border-bottom">
    {{-- 戻るボタン --}}
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>

    {{-- 中央タイトル --}}
    <span class="fw-bold fs-5">投稿</span>

    {{-- 投稿ボタン --}}
    <button type="submit" form="postForm" class="btn btn-primary">
        投稿
    </button>
</div>

        {{-- 投稿フォーム --}}
        <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- コメント入力（最上部） --}}
            <div class="mb-3 mt-3">
            <textarea name="postcontent" class="form-control" rows="4" placeholder="コメントを入力してください" required></textarea>
            </div>

            {{-- プレビュー表示 --}}
        <div id="preview" class="row g-2"></div>
    </form>
</div>

            {{-- 画像選択欄 --}}
        <div class="mb-3">
+           <label class="form-label">画像を選択（最大10枚）</label>
+           <input type="file" name="images[]" class="form-control" id="imageInput" accept="image/*" multiple>
+       </div>



            {{-- プレビュー用スクリプト --}}
<script>
document.getElementById('imageInput').addEventListener('change', function (event) {
    const files = event.target.files;
    const preview = document.getElementById('preview');
    preview.innerHTML = '';

    if (files.length > 10) {
        alert("最大10枚まで選択できます");
        event.target.value = '';
        return;
    }

    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const col = document.createElement('div');
            col.classList.add('col-4');
            col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded">`;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
</script>

            
</body>
</html>