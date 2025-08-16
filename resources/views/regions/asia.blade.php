<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title id="page-title">アジア</title>
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
            font-weight: bold;
            color: #333;
            transition: all 0.2s;
            cursor: pointer;
        }
        .menu-btn:hover { background-color: #e2e6ea; }
        .accordion-body { font-size: 14px; }
        .study-link {
            display: inline-block;
            margin-right: 8px;
            text-decoration: underline;
            color: #0d6efd;
            cursor: pointer;
        }
        .study-link:hover { color: #0a58ca; }
        .travel-count {
            font-size: 18px;  /* フォントサイズ大きめ */
            font-weight: bold;
            color: #d63384;  /* 強調色 */
        }
    </style>
</head>
<body>
<div class="container">

    <!-- 戻るボタン＋中央タイトル -->
    <div class="d-flex align-items-center mb-4 position-relative">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mx-auto" id="continent-title">アジア</h4>
    </div>

    <!-- 国ボタンを自動生成 -->
    <div class="d-flex flex-column align-items-center gap-3" id="country-buttons">
        <!-- JS がボタン生成 -->
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const continent = "アジア";
    document.getElementById('page-title').textContent = continent;
    document.getElementById('continent-title').textContent = continent;

    const countryData = {
        "韓国": { desc: "韓国は東アジアに位置する国で、首都はソウルです。", travel: "約10万人",
                  study: [{name:"ソウル大学",url:"https://www.snu.ac.kr/"},{name:"高麗大学",url:"http://www.korea.ac.kr/"},{name:"延世大学",url:"https://www.yonsei.ac.kr/"}]},
        "シンガポール": { desc:"シンガポールは東南アジアの都市国家で、経済が発展しています。", travel:"約3万人",
                  study:[{name:"シンガポール国立大学",url:"https://www.nus.edu.sg/"},{name:"南洋理工大学",url:"https://www.ntu.edu.sg/"}]},
        "マレーシア": { desc:"マレーシアは多民族国家で、首都はクアラルンプールです。", travel:"約2万人",
                  study:[{name:"マレーシア国立大学",url:"https://www.ukm.my/"},{name:"マレーシア工科大学",url:"https://www.utm.my/"}]},
        "台湾": { desc:"台湾は東アジアの島国で、台北が首都です。", travel:"約4万人",
                  study:[{name:"国立台湾大学",url:"https://www.ntu.edu.tw/"}]},
        "中国": { desc:"中国は世界で最も人口の多い国で、首都は北京です。", travel:"約8万人",
                  study:[{name:"北京大学",url:"http://www.pku.edu.cn/"},{name:"清華大学",url:"https://www.tsinghua.edu.cn/"}]},
        "インド": { desc:"インドは南アジアに位置し、人口は世界第2位です。", travel:"約1.5万人",
                  study:[{name:"インド工科大学デリー校",url:"https://www.iitd.ac.in/"}]},
        "フィリピン": { desc:"フィリピンは東南アジアの島国で、首都はマニラです。", travel:"約2.5万人",
                  study:[{name:"アテネオ・デ・マニラ大学",url:"https://www.ateneo.edu/"}]},
        "ベトナム": { desc:"ベトナムは東南アジアに位置する国で、首都はハノイです。", travel:"約2万人",
                  study:[{name:"ハノイ工科大学",url:"https://www.hust.edu.vn/"}]},
        "タイ": { desc:"タイは東南アジアの王国で、首都はバンコクです。", travel:"約3万人",
                  study:[{name:"チュラロンコン大学",url:"https://www.chula.ac.th/"}]},
        "カンボジア": { desc:"カンボジアは東南アジアの国で、首都はプノンペンです。", travel:"約1万人",
                  study:[{name:"カンボジア王立プノンペン大学",url:"http://www.rupp.edu.kh/"}]}
    };

    const container = document.getElementById('country-buttons');

    Object.keys(countryData).forEach(country => {
        const btn = document.createElement('div');
        btn.classList.add('menu-btn');
        btn.dataset.country = country;
        btn.textContent = country;
        container.appendChild(btn);
    });

    container.addEventListener('click', function(e){
        const btn = e.target.closest('.menu-btn');
        if(!btn) return;

        const country = btn.dataset.country;
        const existing = btn.nextElementSibling;
        if (existing && existing.classList.contains('accordion-body')) {
            existing.remove();
            return;
        }

        const info = countryData[country];
        const body = document.createElement('div');
        body.classList.add('accordion-body');
        body.style.margin = '5px 0 15px 0';
        body.style.padding = '10px';
        body.style.backgroundColor = '#f8f9fa';
        body.style.border = '1px solid #dee2e6';
        body.style.borderRadius = '8px';

        const studyLinks = info.study.map(s => `<a href="${s.url}" target="_blank" class="study-link">${s.name}</a>`).join('、 ');

        body.innerHTML = `
            <p>${info.desc}</p>
            <p>日本からの渡航人数: <span class="travel-count">${info.travel}</span></p>
            <p><strong>主な留学先:</strong> ${studyLinks}</p>
        `;
        btn.insertAdjacentElement('afterend', body);
        body.scrollIntoView({behavior:'smooth'});
    });
});
</script>
</body>
</html>