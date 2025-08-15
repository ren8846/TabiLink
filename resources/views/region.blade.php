<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $slug }} のページ</title>
</head>
<body style="font-family: system-ui, sans-serif; padding: 24px;">
  <a href="{{ route('map') }}">← 地図へ戻る</a>
  <h1 style="margin-top:12px;">{{ strtoupper($slug) }} のページ</h1>
  <p>ここに {{ $slug }} の情報を表示します。</p>
</body>
</html>