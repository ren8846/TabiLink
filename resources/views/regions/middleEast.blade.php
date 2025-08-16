<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>中東</title>
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
        <h4 class="mx-auto">中東</h4>
    </div>

    <!-- 国ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="サウジアラビア">サウジアラビア</div>
        <div class="menu-btn" data-place="アラブ首長国連邦">アラブ首長国連邦</div>
        <div class="menu-btn" data-place="イスラエル">イスラエル</div>
        <div class="menu-btn" data-place="トルコ">トルコ</div>
        <div class="menu-btn" data-place="カタール">カタール</div>
        <div class="menu-btn" data-place="ヨルダン">ヨルダン</div>
        <div class="menu-btn" data-place="クウェート">クウェート</div>
        <div class="menu-btn" data-place="オマーン">オマーン</div>
        <div class="menu-btn" data-place="バーレーン">バーレーン</div>
        <div class="menu-btn" data-place="レバノン">レバノン</div>
        <div class="menu-btn" data-place="シリア">シリア</div>
        <div class="menu-btn" data-place="イラク">イラク</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        'サウジアラビア': { desc: 'サウジアラビアはアラビア半島最大の国で、リヤドが首都です。', travelers: '約2,000人', study: [{ name: 'キング・サウード大学', url: 'https://www.ksu.edu.sa/' }] },
        'アラブ首長国連邦': { desc: 'アラブ首長国連邦は中東の連邦国家で、アブダビが首都です。', travelers: '約1,500人', study: [{ name: 'UAE大学', url: 'https://www.uaeu.ac.ae/en/' }] },
        'イスラエル': { desc: 'イスラエルは中東の国で、エルサレムを名目上の首都としています。', travelers: '約800人', study: [{ name: 'ヘブライ大学', url: 'https://en.huji.ac.il/' }] },
        'トルコ': { desc: 'トルコはアジアとヨーロッパに跨る国で、アンカラが首都です。', travelers: '約3,000人', study: [{ name: 'ボアジチ大学', url: 'https://www.boun.edu.tr/en_US' }] },
        'カタール': { desc: 'カタールは中東の小国で、ドーハが首都です。', travelers: '約500人', study: [] },
        'ヨルダン': { desc: 'ヨルダンは中東に位置し、アンマンが首都です。', travelers: '約400人', study: [] },
        'クウェート': { desc: 'クウェートはペルシャ湾に面した小国で、クウェート市が首都です。', travelers: '約300人', study: [] },
        'オマーン': { desc: 'オマーンはアラビア半島南東部の国で、マスカットが首都です。', travelers: '約200人', study: [] },
        'バーレーン': { desc: 'バーレーンはペルシャ湾の島国で、マナーマが首都です。', travelers: '約150人', study: [] },
        'レバノン': { desc: 'レバノンは地中海東岸の国で、ベイルートが首都です。', travelers: '約120人', study: [] },
        'シリア': { desc: 'シリアは中東の国で、ダマスカスが首都です。', travelers: '約100人', study: [] },
        'イラク': { desc: 'イラクはメソポタミアに位置し、バグダッドが首都です。', travelers: '約90人', study: [] }
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