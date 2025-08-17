<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabiLink</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold mb-6">ようこそ！TabiLinkへ 🌏</h1>
        <p class="mb-8">学びと旅をつなぐ、新しい留学体験。</p>

        @auth
            <a href="{{ url('/dashboard') }}" 
               class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                ダッシュボードへ
            </a>
        @else
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" 
                   class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    ログイン
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    新規登録
                </a>
            </div>
        @endauth
    </div>
</body>
</html>
