<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>アフリカ</title>
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
        <h4 class="mx-auto">アフリカ</h4>
    </div>

    <!-- 国ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="南アフリカ">南アフリカ</div>
        <div class="menu-btn" data-place="ナイジェリア">ナイジェリア</div>
        <div class="menu-btn" data-place="エジプト">エジプト</div>
        <div class="menu-btn" data-place="ケニア">ケニア</div>
        <div class="menu-btn" data-place="ガーナ">ガーナ</div>
        <div class="menu-btn" data-place="モロッコ">モロッコ</div>
        <div class="menu-btn" data-place="チュニジア">チュニジア</div>
        <div class="menu-btn" data-place="タンザニア">タンザニア</div>
        <div class="menu-btn" data-place="ウガンダ">ウガンダ</div>
        <div class="menu-btn" data-place="アルジェリア">アルジェリア</div>
        <div class="menu-btn" data-place="エチオピア">エチオピア</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        '南アフリカ': { desc: '南アフリカはアフリカ南端の国で、プレトリアが行政首都です。', travelers: '約600人', study: [{ name: 'ケープタウン大学', url: 'https://www.uct.ac.za/' }] },
        'ナイジェリア': { desc: 'ナイジェリアはアフリカ西部最大の国で、アブジャが首都です。', travelers: '約500人', study: [{ name: 'ラゴス大学', url: 'https://unilag.edu.ng/' }] },
        'エジプト': { desc: 'エジプトは北アフリカに位置する国で、カイロが首都です。', travelers: '約700人', study: [{ name: 'カイロ大学', url: 'https://cu.edu.eg/' }] },
        'ケニア': { desc: 'ケニアは東アフリカの国で、ナイロビが首都です。', travelers: '約400人', study: [{ name: 'ナイロビ大学', url: 'https://www.uonbi.ac.ke/' }] },
        'ガーナ': { desc: 'ガーナは西アフリカの国で、アクラが首都です。', travelers: '約250人', study: [] },
        'モロッコ': { desc: 'モロッコは北アフリカに位置する国で、ラバトが首都です。', travelers: '約200人', study: [] },
        'チュニジア': { desc: 'チュニジアは地中海に面した国で、チュニスが首都です。', travelers: '約150人', study: [] },
        'タンザニア': { desc: 'タンザニアは東アフリカの国で、ドドマが首都です。', travelers: '約180人', study: [] },
        'ウガンダ': { desc: 'ウガンダは東アフリカの内陸国で、カンパラが首都です。', travelers: '約130人', study: [] },
        'アルジェリア': { desc: 'アルジェリアは北アフリカ最大の国で、アルジェが首都です。', travelers: '約170人', study: [] },
        'エチオピア': { desc: 'エチオピアは東アフリカの内陸国で、アディスアベバが首都です。', travelers: '約120人', study: [] }
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