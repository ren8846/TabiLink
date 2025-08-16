<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>北米</title>
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
        <h4 class="mx-auto">北米</h4>
    </div>

    <!-- 国ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-country="アメリカ">アメリカ</div>
        <div class="menu-btn" data-country="カナダ">カナダ</div>
        <div class="menu-btn" data-country="メキシコ">メキシコ</div>
        <div class="menu-btn" data-country="グアテマラ">グアテマラ</div>
        <div class="menu-btn" data-country="バハマ">バハマ</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const countries = document.querySelectorAll('.menu-btn');

    const countryInfo = {
        'アメリカ': {
            desc: 'アメリカ合衆国は北米最大の国で、首都はワシントンD.C.です。',
            travelers: '約200,000人',
            study: [
                { name: 'ハーバード大学', url: 'https://www.harvard.edu/' },
                { name: 'スタンフォード大学', url: 'https://www.stanford.edu/' }
            ]
        },
        'カナダ': {
            desc: 'カナダは広大な国土を持つ北米の国で、首都はオタワです。',
            travelers: '約50,000人',
            study: [
                { name: 'トロント大学', url: 'https://www.utoronto.ca/' },
                { name: 'ブリティッシュコロンビア大学', url: 'https://www.ubc.ca/' }
            ]
        },
        'メキシコ': {
            desc: 'メキシコは北米南部の国で、首都はメキシコシティです。',
            travelers: '約10,000人',
            study: [
                { name: 'メキシコ国立自治大学', url: 'https://www.unam.mx/' }
            ]
        },
        'グアテマラ': {
            desc: 'グアテマラは中央アメリカの国で、首都はグアテマラシティです。',
            travelers: '約500人',
            study: []
        },
        'バハマ': {
            desc: 'バハマはカリブ海にある島国です。',
            travelers: '約300人',
            study: []
        }
    };

    countries.forEach(btn => {
        btn.addEventListener('click', function () {
            const country = btn.dataset.country;

            // 既に情報が表示されている場合は削除
            const existing = btn.nextElementSibling;
            if (existing && existing.classList.contains('accordion-body')) {
                existing.remove();
                return;
            }

            const info = countryInfo[country];
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