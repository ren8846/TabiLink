<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録 | TabiLink</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 text-gray-800 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">新規登録</h1>
                <p class="text-sm text-gray-500 mt-1">必要事項を入力してください</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium mb-1">ユーザー名</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">メールアドレス</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">パスワード</label>
                    <input id="password" name="password" type="password" required
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium mb-1">パスワード（確認）</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        すでに登録済みの方はこちら
                    </a>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        新規登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
