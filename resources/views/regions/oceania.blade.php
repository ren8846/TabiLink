<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>大洋州</title>
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
        <h4 class="mx-auto">大洋州</h4>
    </div>

    <!-- 国・地域ごとのボタン -->
    <div class="d-flex flex-column align-items-center gap-3">
        <div class="menu-btn" data-place="オーストラリア">オーストラリア</div>
        <div class="menu-btn" data-place="ニュージーランド">ニュージーランド</div>
        <div class="menu-btn" data-place="フィジー">フィジー</div>
        <div class="menu-btn" data-place="パプアニューギニア">パプアニューギニア</div>
        <div class="menu-btn" data-place="サモア">サモア</div>
        <div class="menu-btn" data-place="バヌアツ">バヌアツ</div>
        <div class="menu-btn" data-place="トンガ">トンガ</div>
        <div class="menu-btn" data-place="クック諸島">クック諸島</div>
        <div class="menu-btn" data-place="ソロモン諸島">ソロモン諸島</div>
        <div class="menu-btn" data-place="キリバス">キリバス</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const places = document.querySelectorAll('.menu-btn');

    const placeInfo = {
        'オーストラリア': { desc: 'オーストラリアは大洋州最大の国で、シドニーやメルボルンがあります。', travelers: '約25,000人', study: [{ name: 'オーストラリア国立大学', url: 'https://www.anu.edu.au/' }, { name: 'メルボルン大学', url: 'https://www.unimelb.edu.au/' }] },
        'ニュージーランド': { desc: 'ニュージーランドは南太平洋の島国で、オークランドやウェリントンがあります。', travelers: '約5,000人', study: [{ name: 'オークランド大学', url: 'https://www.auckland.ac.nz/' }, { name: 'オタゴ大学', url: 'https://www.otago.ac.nz/' }] },
        'フィジー': { desc: 'フィジーは南太平洋の島国で、美しいリゾート地として知られています。', travelers: '約500人', study: [] },
        'パプアニューギニア': { desc: 'パプアニューギニアは大洋州北部の島国です。', travelers: '約300人', study: [] },
        'サモア': { desc: 'サモアは南太平洋の島国で、伝統文化が色濃く残っています。', travelers: '約200人', study: [] },
        'バヌアツ': { desc: 'バヌアツは南太平洋の小さな島国です。', travelers: '約100人', study: [] },
        'トンガ': { desc: 'トンガは南太平洋の王国で、多くの島々から成ります。', travelers: '約80人', study: [] },
        'クック諸島': { desc: 'クック諸島はニュージーランドと関係の深い小国です。', travelers: '約50人', study: [] },
        'ソロモン諸島': { desc: 'ソロモン諸島は南太平洋の島国で、熱帯雨林が広がります。', travelers: '約70人', study: [] },
        'キリバス': { desc: 'キリバスは赤道直下の島国で、多くのサンゴ礁があります。', travelers: '約60人', study: [] }
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
            if (info.study.length > 0) { studyHtml = '<p>主な留学先: ' + info.study.map(s => `<a href="${s.url}" target="_blank">${s.name}</a>`).join(', ') + '</p>'; }

            body.innerHTML = `<p>${info.desc}</p><p class="highlight">日本からの渡航人数: ${info.travelers}</p>${studyHtml}`;
            btn.insertAdjacentElement('afterend', body);
            body.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>
</body>
</html>