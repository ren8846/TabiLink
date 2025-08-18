<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>近畿</title>
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
        .job-link {
            display: inline-block;
            margin-top: 8px;
            text-decoration: underline;
            color: #0d6efd;
            cursor: pointer;
        }
        .job-link:hover { color: #0a58ca; }
        .salary {
            font-size: 16px;
            font-weight: bold;
            color: #198754;
        }
        .worker-count {
            font-size: 16px;
            font-weight: bold;
            color: #d63384;
        }
        .job-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">

   <!-- タイトルと戻るボタン -->
   <div class="d-flex align-items-center mb-4 position-relative">
       <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
           <i class="bi bi-arrow-left"></i>
       </a>
       <h4 class="mx-auto">近畿</h4>
   </div>

    <!-- 県ボタン -->
    <div class="d-flex flex-column align-items-center gap-3" id="prefecture-buttons">
        <!-- JSで自動生成 -->
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const prefectureData = {
        "滋賀県": { workers: 320, jobs: [
            {title:"温泉宿スタッフ", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shiga-onsen.jpg", url:"https://resortbaito-dive.com/offer/shiga-onsen"},
            {title:"琵琶湖マリンスタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shiga-marine.jpg", url:"https://resortbaito-dive.com/offer/shiga-marine"}
        ]},
        "京都府": { workers: 700, jobs: [
            {title:"旅館仲居", salary:"月給24万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/kyoto-nakai.jpg", url:"https://resortbaito-dive.com/offer/kyoto-nakai"},
            {title:"ホテルフロント", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/kyoto-hotel.jpg", url:"https://resortbaito-dive.com/offer/kyoto-hotel"}
        ]},
        "大阪府": { workers: 820, jobs: [
            {title:"テーマパークスタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/osaka-themepark.jpg", url:"https://resortbaito-dive.com/offer/osaka-themepark"},
            {title:"ホテル清掃スタッフ", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/osaka-clean.jpg", url:"https://resortbaito-dive.com/offer/osaka-clean"}
        ]},
        "兵庫県": { workers: 610, jobs: [
            {title:"有馬温泉スタッフ", salary:"月給23万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/hyogo-onsen.jpg", url:"https://resortbaito-dive.com/offer/hyogo-onsen"},
            {title:"神戸ホテルスタッフ", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/hyogo-hotel.jpg", url:"https://resortbaito-dive.com/offer/hyogo-hotel"}
        ]},
        "奈良県": { workers: 280, jobs: [
            {title:"寺院宿坊スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/nara-shukubo.jpg", url:"https://resortbaito-dive.com/offer/nara-shukubo"},
            {title:"観光案内スタッフ", salary:"月給18万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/nara-guide.jpg", url:"https://resortbaito-dive.com/offer/nara-guide"}
        ]},
        "和歌山県": { workers: 350, jobs: [
            {title:"南紀白浜リゾート", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/wakayama-resort.jpg", url:"https://resortbaito-dive.com/offer/wakayama-resort"},
            {title:"熊野古道ガイド", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/wakayama-guide.jpg", url:"https://resortbaito-dive.com/offer/wakayama-guide"}
        ]}
    };

    const container = document.getElementById('prefecture-buttons');

    Object.keys(prefectureData).forEach(pref => {
        const btn = document.createElement('div');
        btn.classList.add('menu-btn');
        btn.dataset.prefecture = pref;
        btn.textContent = pref;
        container.appendChild(btn);
    });

    container.addEventListener('click', function(e){
        const btn = e.target.closest('.menu-btn');
        if(!btn) return;

        const pref = btn.dataset.prefecture;
        const existing = btn.nextElementSibling;
        if (existing && existing.classList.contains('accordion-body')) {
            existing.remove();
            return;
        }

        const info = prefectureData[pref];
        const body = document.createElement('div');
        body.classList.add('accordion-body');
        body.style.margin = '5px 0 15px 0';
        body.style.padding = '10px';
        body.style.backgroundColor = '#f8f9fa';
        body.style.border = '1px solid #dee2e6';
        body.style.borderRadius = '8px';

        const jobList = info.jobs.map(job => `
            <div>
                <img src="${job.img}" class="job-image" alt="${job.title}">
                <p><strong>${job.title}</strong></p>
                <p class="salary">推定給料: ${job.salary}</p>
                <a href="${job.url}" target="_blank" class="job-link">求人ページへ</a>
            </div>
            <hr>
        `).join('');

        body.innerHTML = `
            <p>この県でリゾートバイトしている人数: <span class="worker-count">${info.workers}人</span></p>
            ${jobList}
        `;

        btn.insertAdjacentElement('afterend', body);
        body.scrollIntoView({behavior:'smooth'});
    });
});
</script>
</body>
</html>