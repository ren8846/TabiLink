<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>関東</title>
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
       <h4 class="mx-auto">関東</h4>
   </div>

    <!-- 県ボタン -->
    <div class="d-flex flex-column align-items-center gap-3" id="prefecture-buttons">
        <!-- JSで自動生成 -->
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const prefectureData = {
        "茨城県": { workers: 420, jobs: [
            {title:"ホテルフロントスタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/ibaraki-hotel.jpg", url:"https://resortbaito-dive.com/offer/ibaraki-hotel"},
            {title:"温泉清掃スタッフ", salary:"月給18万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/ibaraki-onsen.jpg", url:"https://resortbaito-dive.com/offer/ibaraki-onsen"}
        ]},
        "栃木県": { workers: 510, jobs: [
            {title:"旅館仲居", salary:"月給23万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tochigi-nakai.jpg", url:"https://resortbaito-dive.com/offer/tochigi-nakai"},
            {title:"スキー場スタッフ", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tochigi-ski.jpg", url:"https://resortbaito-dive.com/offer/tochigi-ski"}
        ]},
        "群馬県": { workers: 480, jobs: [
            {title:"温泉宿フロント", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/gunma-onsen.jpg", url:"https://resortbaito-dive.com/offer/gunma-onsen"},
            {title:"調理補助", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/gunma-cook.jpg", url:"https://resortbaito-dive.com/offer/gunma-cook"}
        ]},
        "埼玉県": { workers: 530, jobs: [
            {title:"ホテル清掃スタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/saitama-clean.jpg", url:"https://resortbaito-dive.com/offer/saitama-clean"},
            {title:"レストランホール", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/saitama-restaurant.jpg", url:"https://resortbaito-dive.com/offer/saitama-restaurant"}
        ]},
        "千葉県": { workers: 600, jobs: [
            {title:"リゾートホテルスタッフ", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/chiba-hotel.jpg", url:"https://resortbaito-dive.com/offer/chiba-hotel"},
            {title:"テーマパークスタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/chiba-themepark.jpg", url:"https://resortbaito-dive.com/offer/chiba-themepark"}
        ]},
        "東京都": { workers: 750, jobs: [
            {title:"高級ホテルフロント", salary:"月給25万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tokyo-hotel.jpg", url:"https://resortbaito-dive.com/offer/tokyo-hotel"},
            {title:"イベントスタッフ", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/tokyo-event.jpg", url:"https://resortbaito-dive.com/offer/tokyo-event"}
        ]},
        "神奈川県": { workers: 680, jobs: [
            {title:"温泉宿受付", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/kanagawa-onsen.jpg", url:"https://resortbaito-dive.com/offer/kanagawa-onsen"},
            {title:"マリンスポーツスタッフ", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/kanagawa-marine.jpg", url:"https://resortbaito-dive.com/offer/kanagawa-marine"}
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