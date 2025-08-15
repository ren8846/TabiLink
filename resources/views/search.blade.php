{{-- resources/views/search.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索ページ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .tab-buttons button {
            margin: 5px;
            padding: 6px 12px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            border-radius: 20px;
            cursor: pointer;
        }
        .tab-buttons button:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body class="p-3">

<!-- 検索バー -->
<div class="d-flex align-items-center mb-3">
    <!-- 戻るボタン -->
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- 検索入力 -->
    <input type="text" id="searchInput" class="form-control me-2" placeholder="キーワードを入力">

    <!-- 検索ボタン -->
    <button id="searchButton" class="btn btn-primary">
        <i class="bi bi-search"></i>
    </button>
</div>

<!-- タグ一覧 -->
<div class="tab-buttons mb-3">
    @php
        $tags = [
            'オーストラリア', '日本', '留学', '観光', 'アジア', '温泉', '京都', '東京', '北海道',
            '沖縄', 'グルメ', 'ヨーロッパ', 'ワーホリ', 'ダイビング', 'カフェ', '世界遺産', '寺', '歴史',
            '美術館', '夜景', 'イベント', 'フェス', '韓国', '紅葉', '花見', 'スキー', 'フィリピン',
            'イギリス', 'マルタ', 
        ];
    @endphp
    @foreach ($tags as $tag)
        <button>{{ $tag }}</button>
    @endforeach
</div>

<!-- 検索結果表示エリア -->
<div id="searchResults" class="mt-3"></div>

<script>
    // タグクリックで複数キーワード追加
    document.querySelectorAll('.tab-buttons button').forEach(button => {
        button.addEventListener('click', () => {
            const searchInput = document.getElementById('searchInput');
            const keyword = button.textContent;

            if (searchInput.value.trim() !== '') {
                searchInput.value += ' ' + keyword;
            } else {
                searchInput.value = keyword;
            }
        });
    });

    // 検索ボタンクリックで結果表示
    document.getElementById('searchButton').addEventListener('click', () => {
        const keywords = document.getElementById('searchInput').value.trim();

        if (keywords === '') {
            document.getElementById('searchResults').innerHTML =
                '<p class="text-muted">キーワードを入力してください。</p>';
            return;
        }

        // 仮の検索結果（実際はサーバーから取得する）
        document.getElementById('searchResults').innerHTML =
            `<p><strong>「${keywords}」</strong> の検索結果</p>
             <ul>
                <li>サンプル結果1</li>
                <li>サンプル結果2</li>
                <li>サンプル結果3</li>
             </ul>`;
    });
</script>

</body>
</html>