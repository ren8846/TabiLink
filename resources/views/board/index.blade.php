{{-- resources/views/board/index.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        .title-header {
            position: relative;
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .title-header h4 {
            margin: 0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- 戻るボタン＋中央タイトル -->
    <div class="title-header">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mx-auto">掲示板</h4>
    </div>

    <main>
        只今メンテナンス中
    </main>

</body>
</html>