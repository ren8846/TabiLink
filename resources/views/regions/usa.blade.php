<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>アメリカ</title>
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
        <h4 class="mx-auto">アメリカ</h4>
    </div>

    <!-- 州・都市ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="カリフォルニア州">カリフォルニア州</div>
        <div class="menu-btn" data-place="ニューヨーク州">ニューヨーク州</div>
        <div class="menu-btn" data-place="マサチューセッツ州">マサチューセッツ州</div>
        <div class="menu-btn" data-place="テキサス州">テキサス州</div>
        <div class="menu-btn" data-place="イリノイ州">イリノイ州</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        'カリフォルニア州': {
            desc: 'アメリカ西海岸に位置する州で、ロサンゼルスやサンフランシスコがあります。',
            travelers: '約50,000人',
            study: [
                { name: 'スタンフォード大学', url: 'https://www.stanford.edu/' },
                { name: 'カリフォルニア大学バークレー校', url: 'https://www.berkeley.edu/' }
            ]
        },
        'ニューヨーク州': {
            desc: 'アメリカ北東部に位置する州で、ニューヨーク市があります。',
            travelers: '約40,000人',
            study: [
                { name: 'コロンビア大学', url: 'https://www.columbia.edu/' },
                { name: 'ニューヨーク大学', url: 'https://www.nyu.edu/' }
            ]
        },
        'マサチューセッツ州': {
            desc: 'アメリカ北東部の州で、ボストンが主要都市です。',
            travelers: '約15,000人',
            study: [
                { name: 'ハーバード大学', url: 'https://www.harvard.edu/' },
                { name: 'マサチューセッツ工科大学（MIT）', url: 'http://web.mit.edu/' }
            ]
        },
        'テキサス州': {
            desc: 'アメリカ南部に位置する州で、オースティンやヒューストンがあります。',
            travelers: '約8,000人',
            study: []
        },
        'イリノイ州': {
            desc: 'アメリカ中西部にある州で、シカゴが主要都市です。',
            travelers: '約5,000人',
            study: [
                { name: 'シカゴ大学', url: 'https://www.uchicago.edu/' }
            ]
        }
    };

    places.forEach(btn => {
        btn.addEventListener('click', function () {
            const place = btn.dataset.place;

            // 既に情報が表示されている場合は削除
            const existing = btn.nextElementSibling;
            if (existing && existing.classList.contains('accordion-body')) {
                existing.remove();
                return;
            }

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

            body.innerHTML = `
                <p>${info.desc}</p>
                <p class="highlight">日本からの渡航人数: ${info.travelers}</p>
                ${studyHtml}
            `;

            btn.insertAdjacentElement('afterend', body);
            body.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>
</body>
</html>