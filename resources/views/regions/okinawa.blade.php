<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>沖縄</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { margin: 0; font-family: sans-serif; }
        .container { margin-top: 20px; }
        .menu-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 260px;
            padding: 12px 16px;
            background-color: #f0f9ff;
            border: 1px solid #90caf9;
            border-radius: 12px;
            font-weight: bold;
            color: #0d47a1;
            transition: all 0.2s;
            cursor: pointer;
        }
        .menu-btn:hover { background-color: #bbdefb; }
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
       <h4 class="mx-auto">沖縄</h4>
   </div>

    <!-- エリアボタン -->
    <div class="d-flex flex-column align-items-center gap-3" id="area-buttons">
        <!-- JSで自動生成 -->
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const areaData = {
        "本島北部": { workers: 500, jobs: [
            {title:"リゾートホテルフロント（恩納村）", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okinawa-onnason.jpg", url:"https://resortbaito-dive.com/offer/okinawa-onnason"},
            {title:"マリンスポーツスタッフ（名護）", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okinawa-marine.jpg", url:"https://resortbaito-dive.com/offer/okinawa-marine"}
        ]},
        "本島南部": { workers: 450, jobs: [
            {title:"シティホテル受付（那覇市）", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okinawa-naha.jpg", url:"https://resortbaito-dive.com/offer/okinawa-naha"},
            {title:"飲食店スタッフ（南城市）", salary:"月給19万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/okinawa-food.jpg", url:"https://resortbaito-dive.com/offer/okinawa-food"}
        ]},
        "宮古諸島": { workers: 380, jobs: [
            {title:"リゾートホテルスタッフ（宮古島）", salary:"月給23万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/miyako-hotel.jpg", url:"https://resortbaito-dive.com/offer/miyako-hotel"},
            {title:"空港グランドスタッフ（下地島）", salary:"月給21万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/miyako-airport.jpg", url:"https://resortbaito-dive.com/offer/miyako-airport"}
        ]},
        "八重山諸島": { workers: 420, jobs: [
            {title:"リゾートホテルスタッフ（石垣島）", salary:"月給22万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/ishigaki-hotel.jpg", url:"https://resortbaito-dive.com/offer/ishigaki-hotel"},
            {title:"ツアーガイド補助（西表島）", salary:"月給20万円", img:"https://resortbaito-dive.s3.ap-northeast-1.amazonaws.com/job-image/iriomote-tour.jpg", url:"https://resortbaito-dive.com/offer/iriomote-tour"}
        ]}
    };

    const container = document.getElementById('area-buttons');

    Object.keys(areaData).forEach(area => {
        const btn = document.createElement('div');
        btn.classList.add('menu-btn');
        btn.dataset.area = area;
        btn.textContent = area;
        container.appendChild(btn);
    });

    container.addEventListener('click', function(e){
        const btn = e.target.closest('.menu-btn');
        if(!btn) return;

        const area = btn.dataset.area;
        const existing = btn.nextElementSibling;
        if (existing && existing.classList.contains('accordion-body')) {
            existing.remove();
            return;
        }

        const info = areaData[area];
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
            <p>このエリアでリゾートバイトしている人数: <span class="worker-count">${info.workers}人</span></p>
            ${jobList}
        `;

        btn.insertAdjacentElement('afterend', body);
        body.scrollIntoView({behavior:'smooth'});
    });
});
</script>
</body>
</html>