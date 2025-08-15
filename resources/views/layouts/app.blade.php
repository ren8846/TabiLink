{{-- resources/views/layouts/app.blade.php --}}
<!DOQTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', config('app.name', 'TabiLink'))</title>

  <!-- Bootstrap / Icons（必要なければ外してOK）-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

@php
    $hideChrome = request()->routeIs([
        '#'
    ]);
@endphp
    <!-- {{-- 非表示にしたいルートを必要に応じて追加 --}}
    {{--ここで Chrome（ヘッダー/ボトムナビ）表示可否を判定--}} -->

@unless($hideChrome)
  @includeIf('layouts.header')      <!-- 無ければ落ちないよう includeIf -->
@endunless

<main class="container py-4 {{ $hideChrome ? '' : 'main-has-bottom' }}">
  @yield('content')
</main>

@unless($hideChrome)
  @includeIf('layouts.bottom-nav')  <!-- 使っていなければ削除OK -->
  <!-- @includeIf('layouts.footer')      {{-- 使っていなければ削除OK --}} -->
@endunless

@stack('scripts')
</body>
</html>
