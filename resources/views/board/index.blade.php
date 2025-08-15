{{-- resources/views/board/index.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        header {
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 10px;
            border-bottom: 1px solid #ddd;
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

    <header>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">&lt; 戻る</a>
    </header>

    <main>
        只今メンテナンス中
    </main>

</body>
</html>