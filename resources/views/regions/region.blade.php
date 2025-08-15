<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $region['title'] }}ページ</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; }
    h1 { font-size: 28px; }
    img { max-width: 100%; height: auto; margin-top: 20px; border-radius: 8px; }
    a { display: inline-block; margin-top: 20px; text-decoration: none; color: #007BFF; }
  </style>
</head>
<body>
  <h1>{{ $region['title'] }}</h1>
  <p>{{ $region['description'] }}</p>
  @if(isset($region['image']))
    <img src="{{ $region['image'] }}" alt="{{ $region['title'] }}">
  @endif
  <a href="/">← ホームに戻る</a>
</body>
</html>