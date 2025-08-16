<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ヨーロッパ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { margin: 0; font-family: sans-serif; }
        .container { margin-top: 20px; }
        .menu-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 250px;
            padding: 12px 16px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            color: #333;
            transition: all 0.2s;
            cursor: pointer;
        }
        .menu-btn:hover { background-color: #e2e6ea; }
        .accordion-body { font-size: 14px; }
        .highlight { font-size: 18px; font-weight: bold; color: #ff6347; }
    </style>
</head>
<body>
<div class="container">

    <!-- 戻るボタン＋中央タイトル -->
    <div class="d-flex align-items-center mb-4 position-relative">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mx-auto">ヨーロッパ</h4>
    </div>

    <!-- 国ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="フランス">フランス</div>
        <div class="menu-btn" data-place="ドイツ">ドイツ</div>
        <div class="menu-btn" data-place="イギリス">イギリス</div>
        <div class="menu-btn" data-place="イタリア">イタリア</div>
        <div class="menu-btn" data-place="スペイン">スペイン</div>
        <div class="menu-btn" data-place="オランダ">オランダ</div>
        <div class="menu-btn" data-place="スイス">スイス</div>
        <div class="menu-btn" data-place="スウェーデン">スウェーデン</div>
        <div class="menu-btn" data-place="ベルギー">ベルギー</div>
        <div class="menu-btn" data-place="ノルウェー">ノルウェー</div>
        <div class="menu-btn" data-place="ポルトガル">ポルトガル</div>
        <div class="menu-btn" data-place="デンマーク">デンマーク</div>
        <div class="menu-btn" data-place="オーストリア">オーストリア</div>
        <div class="menu-btn" data-place="フィンランド">フィンランド</div>
        <div class="menu-btn" data-place="ギリシャ">ギリシャ</div>
        <div class="menu-btn" data-place="アイスランド">アイスランド</div>
        <div class="menu-btn" data-place="アイルランド">アイルランド</div>
        <div class="menu-btn" data-place="ルクセンブルク">ルクセンブルク</div>
        <div class="menu-btn" data-place="モナコ">モナコ</div>
        <div class="menu-btn" data-place="マルタ">マルタ</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        'フランス': { desc: 'フランスは西ヨーロッパに位置し、パリが首都です。', travelers: '約20,000人', study: [{ name: 'ソルボンヌ大学', url: 'https://www.sorbonne-universite.fr/' }] },
        'ドイツ': { desc: 'ドイツは中央ヨーロッパに位置し、ベルリンが首都です。', travelers: '約15,000人', study: [{ name: 'ハイデルベルク大学', url: 'https://www.uni-heidelberg.de/en' }] },
        'イギリス': { desc: 'イギリスは北西ヨーロッパの島国で、ロンドンが首都です。', travelers: '約18,000人', study: [{ name: 'オックスフォード大学', url: 'https://www.ox.ac.uk/' }, { name: 'ケンブリッジ大学', url: 'https://www.cam.ac.uk/' }] },
        'イタリア': { desc: 'イタリアは南ヨーロッパに位置し、ローマが首都です。', travelers: '約7,000人', study: [] },
        'スペイン': { desc: 'スペインはイベリア半島に位置し、マドリードが首都です。', travelers: '約6,000人', study: [] },
        'オランダ': { desc: 'オランダは北西ヨーロッパの国で、アムステルダムが首都です。', travelers: '約4,000人', study: [] },
        'スイス': { desc: 'スイスは中央ヨーロッパに位置し、ベルンが首都です。', travelers: '約3,000人', study: [] },
        'スウェーデン': { desc: 'スウェーデンは北ヨーロッパに位置し、ストックホルムが首都です。', travelers: '約2,000人', study: [] },
        'ベルギー': { desc: 'ベルギーは北西ヨーロッパに位置し、ブリュッセルが首都です。', travelers: '約1,500人', study: [] },
        'ノルウェー': { desc: 'ノルウェーは北ヨーロッパに位置し、オスロが首都です。', travelers: '約1,000人', study: [] },
        'ポルトガル': { desc: 'ポルトガルはイベリア半島に位置し、リスボンが首都です。', travelers: '約800人', study: [] },
        'デンマーク': { desc: 'デンマークは北ヨーロッパに位置し、コペンハーゲンが首都です。', travelers: '約700人', study: [] },
        'オーストリア': { desc: 'オーストリアは中央ヨーロッパに位置し、ウィーンが首都です。', travelers: '約600人', study: [] },
        'フィンランド': { desc: 'フィンランドは北ヨーロッパに位置し、ヘルシンキが首都です。', travelers: '約500人', study: [] },
        'ギリシャ': { desc: 'ギリシャは南東ヨーロッパに位置し、アテネが首都です。', travelers: '約400人', study: [] },
        'アイスランド': { desc: 'アイスランドは北大西洋の島国です。', travelers: '約300人', study: [] },
        'アイルランド': { desc: 'アイルランドは西ヨーロッパの島国で、ダブリンが首都です。', travelers: '約250人', study: [] },
        'ルクセンブルク': { desc: 'ルクセンブルクは小国で、ルクセンブルク市が首都です。', travelers: '約150人', study: [] },
        'モナコ': { desc: 'モナコは小さな都市国家で、観光が盛んです。', travelers: '約100人', study: [] },
        'マルタ': { desc: 'マルタは地中海の島国で、バレッタが首都です。', travelers: '約120人', study: [] }
    };

    places.forEach(btn => {
        btn.addEventListener('click', function () {
            const place = btn.dataset.place;
            const existing = btn.nextElementSibling;
            if (existing && existing.classList.contains('accordion-body')) { existing.remove(); return; }

            const info = placeInfo[place];
            const body = document.createElement('div');
            body.classList.add('accordion-body');
            body.style.margin = '5px 0 15px 0';
            body.style.padding = '10px';
            body.style.backgroundColor = '#f8f9fa';
            body.style.border = '1px solid #dee2e6';
            body.style.borderRadius = '8px';

            let studyHtml = '';
            if (info.study.length > 0) {
                studyHtml = '<p>主な留学先: ' + info.study.map(s => `<a href="${s.url}" target="_blank">${s.name}</a>`).join(', ') + '</p>';
            }

            body.innerHTML = `<p>${info.desc}</p><p class="highlight">日本からの渡航人数: ${info.travelers}</p>${studyHtml}`;
            btn.insertAdjacentElement('afterend', body);
            body.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>
</body>
</html>