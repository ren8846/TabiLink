<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>中南米</title>
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
        <h4 class="mx-auto">中南米</h4>
    </div>

    <!-- 国ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="ブラジル">ブラジル</div>
        <div class="menu-btn" data-place="メキシコ">メキシコ</div>
        <div class="menu-btn" data-place="アルゼンチン">アルゼンチン</div>
        <div class="menu-btn" data-place="チリ">チリ</div>
        <div class="menu-btn" data-place="コロンビア">コロンビア</div>
        <div class="menu-btn" data-place="ペルー">ペルー</div>
        <div class="menu-btn" data-place="ウルグアイ">ウルグアイ</div>
        <div class="menu-btn" data-place="パラグアイ">パラグアイ</div>
        <div class="menu-btn" data-place="ボリビア">ボリビア</div>
        <div class="menu-btn" data-place="ベネズエラ">ベネズエラ</div>
        <div class="menu-btn" data-place="エクアドル">エクアドル</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        'ブラジル': { desc: 'ブラジルは南アメリカ最大の国で、首都はブラジリアです。', travelers: '約500人', study: [{ name: 'サンパウロ大学', url: 'https://www.usp.br/' }] },
        'メキシコ': { desc: 'メキシコは北中米に位置する国で、首都はメキシコシティです。', travelers: '約300人', study: [{ name: 'メキシコ国立自治大学', url: 'https://www.unam.mx/' }] },
        'アルゼンチン': { desc: 'アルゼンチンは南アメリカ南部の国で、首都はブエノスアイレスです。', travelers: '約200人', study: [{ name: 'ブエノスアイレス大学', url: 'https://www.uba.ar/' }] },
        'チリ': { desc: 'チリは南アメリカ西岸の国で、首都はサンティアゴです。', travelers: '約150人', study: [] },
        'コロンビア': { desc: 'コロンビアは南アメリカ北部の国で、首都はボゴタです。', travelers: '約180人', study: [] },
        'ペルー': { desc: 'ペルーは南アメリカ西部の国で、首都はリマです。', travelers: '約120人', study: [] },
        'ウルグアイ': { desc: 'ウルグアイは南アメリカ南東部の小国で、首都はモンテビデオです。', travelers: '約80人', study: [] },
        'パラグアイ': { desc: 'パラグアイは南アメリカ内陸国で、首都はアスンシオンです。', travelers: '約70人', study: [] },
        'ボリビア': { desc: 'ボリビアは南アメリカ内陸国で、首都はスクレです。', travelers: '約60人', study: [] },
        'ベネズエラ': { desc: 'ベネズエラは南アメリカ北部の国で、首都はカラカスです。', travelers: '約90人', study: [] },
        'エクアドル': { desc: 'エクアドルは南アメリカ北西部の国で、首都はキトです。', travelers: '約50人', study: [] }
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