<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>北陸・東海</title>
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
        .region-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
            text-align: center;
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
       <h4 class="mx-auto">北陸・東海</h4>
   </div>

   <!-- 北陸 -->
   <div class="region-title">北陸</div>
   <div class="d-flex flex-column align-items-center gap-3" id="hokuriku-buttons"></div>

   <!-- 東海 -->
   <div class="region-title">東海</div>
   <div class="d-flex flex-column align-items-center gap-3" id="tokai-buttons"></div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // 北陸
    const hokurikuData = {
        "富山県": { workers: 300, jobs: [
            {title:"旅館スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/toyama-ryokan.jpg", url:"https://resortbaito-dive.com/offer/toyama-ryokan"},
            {title:"スキー場スタッフ", salary:"月給18万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/toyama-ski.jpg", url:"https://resortbaito-dive.com/offer/toyama-ski"}
        ]},
        "石川県": { workers: 350, jobs: [
            {title:"温泉旅館仲居", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/ishikawa-onsen.jpg", url:"https://resortbaito-dive.com/offer/ishikawa-onsen"},
            {title:"ホテル清掃", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/ishikawa-clean.jpg", url:"https://resortbaito-dive.com/offer/ishikawa-clean"}
        ]},
        "福井県": { workers: 280, jobs: [
            {title:"レストランホール", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/fukui-restaurant.jpg", url:"https://resortbaito-dive.com/offer/fukui-restaurant"},
            {title:"温泉清掃", salary:"月給18万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/fukui-onsen.jpg", url:"https://resortbaito-dive.com/offer/fukui-onsen"}
        ]}
    };

    // 東海
    const tokaiData = {
        "岐阜県": { workers: 400, jobs: [
            {title:"スキー場リフト係", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/gifu-ski.jpg", url:"https://resortbaito-dive.com/offer/gifu-ski"},
            {title:"旅館スタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/gifu-ryokan.jpg", url:"https://resortbaito-dive.com/offer/gifu-ryokan"}
        ]},
        "静岡県": { workers: 520, jobs: [
            {title:"リゾートホテルスタッフ", salary:"月給23万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shizuoka-hotel.jpg", url:"https://resortbaito-dive.com/offer/shizuoka-hotel"},
            {title:"温泉街スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shizuoka-onsen.jpg", url:"https://resortbaito-dive.com/offer/shizuoka-onsen"}
        ]},
        "愛知県": { workers: 600, jobs: [
            {title:"テーマパークスタッフ", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/aichi-themepark.jpg", url:"https://resortbaito-dive.com/offer/aichi-themepark"},
            {title:"シティホテルフロント", salary:"月給24万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/aichi-hotel.jpg", url:"https://resortbaito-dive.com/offer/aichi-hotel"}
        ]},
        "三重県": { workers: 350, jobs: [
            {title:"旅館仲居", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/mie-nakai.jpg", url:"https://resortbaito-dive.com/offer/mie-nakai"},
            {title:"海の家スタッフ", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/mie-umi.jpg", url:"https://resortbaito-dive.com/offer/mie-umi"}
        ]}
    };

    function renderButtons(regionData, containerId){
        const container = document.getElementById(containerId);

        Object.keys(regionData).forEach(pref => {
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

            const info = regionData[pref];
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
    }

    renderButtons(hokurikuData, "hokuriku-buttons");
    renderButtons(tokaiData, "tokai-buttons");

});
</script>
</body>
</html>