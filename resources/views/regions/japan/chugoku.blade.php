<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>中国地方</title>
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
       <h4 class="mx-auto">中国地方</h4>
   </div>

    <!-- 県ボタン -->
    <div class="d-flex flex-column align-items-center gap-3" id="prefecture-buttons">
        <!-- JSで自動生成 -->
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const prefectureData = {
        "鳥取県": { workers: 210, jobs: [
            {title:"砂丘観光スタッフ", salary:"月給18万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tottori-sand.jpg", url:"https://resortbaito-dive.com/offer/tottori-sand"},
            {title:"旅館スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tottori-ryokan.jpg", url:"https://resortbaito-dive.com/offer/tottori-ryokan"}
        ]},
        "島根県": { workers: 250, jobs: [
            {title:"出雲大社観光案内", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shimane-izumo.jpg", url:"https://resortbaito-dive.com/offer/shimane-izumo"},
            {title:"温泉宿スタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/shimane-onsen.jpg", url:"https://resortbaito-dive.com/offer/shimane-onsen"}
        ]},
        "岡山県": { workers: 400, jobs: [
            {title:"倉敷美観地区スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okayama-kurashiki.jpg", url:"https://resortbaito-dive.com/offer/okayama-kurashiki"},
            {title:"温泉宿スタッフ", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okayama-onsen.jpg", url:"https://resortbaito-dive.com/offer/okayama-onsen"}
        ]},
        "広島県": { workers: 650, jobs: [
            {title:"宮島観光スタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/hiroshima-miyajima.jpg", url:"https://resortbaito-dive.com/offer/hiroshima-miyajima"},
            {title:"ホテルスタッフ", salary:"月給23万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/hiroshima-hotel.jpg", url:"https://resortbaito-dive.com/offer/hiroshima-hotel"}
        ]},
        "山口県": { workers: 300, jobs: [
            {title:"角島観光スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/yamaguchi-tsunoshima.jpg", url:"https://resortbaito-dive.com/offer/yamaguchi-tsunoshima"},
            {title:"温泉宿スタッフ", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/yamaguchi-onsen.jpg", url:"https://resortbaito-dive.com/offer/yamaguchi-onsen"}
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