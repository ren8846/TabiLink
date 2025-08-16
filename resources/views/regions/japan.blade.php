<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>日本</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
    }
    .title-header {
      position: relative;
      width: 100%;
      height: 50px;
      display: flex;
      align-items: center;
      z-index: 1000;
    }
    .title-header h4 {
      margin: 0;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      font-size: 18px;
      font-weight: bold;
    }
    .title-header .back-btn {
      position: absolute;
      left: 10px;
      background: #eee;
      padding: 6px 10px;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #000;
      font-size: 16px;
    }
    #map {
      height: calc(100vh - 50px);
      width: 100%;
    }
    .label-icon { 
      background: white; 
      border: 1px solid #555; 
      border-radius: 4px; 
      padding: 2px 5px; 
      font-size: 12px; 
      font-weight: bold; 
      white-space: nowrap; 
    }
  </style>
</head>
<body>

<!-- 戻るボタン＋中央タイトル -->
<div class="title-header">
   <a href="{{ route('map') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i>
</a>
    <h4>日本</h4>
</div>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // 地図初期設定
  var map = L.map('map', { 
    zoomControl: false,
    minZoom: 5,
    maxZoom: 10
  }).setView([37.5, 137.5], 5);

  // タイルレイヤー
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // 都道府県マーカー
 var regions = [
    { name: "北海道", lat: 43.06417, lng: 141.34694, url: "/region/hokkaido" },
    { name: "東北", lat: 40.3, lng: 140.7, url: "/region/tohoku" }, // ← 左に移動
    { name: "関東", lat: 35.6895, lng: 139.6917, url: "/region/kanto" },
    { name: "北陸・東海", lat: 36.2048, lng: 136.2529, url: "/region/hokuriku-tokai" },
    { name: "近畿", lat: 34.68639, lng: 135.52, url: "/region/kinki" },
    { name: "中国", lat: 35.3, lng: 132.459, url: "/region/chugoku" }, // ← 上に移動
    { name: "四国", lat: 33.84167, lng: 133.53111, url: "/region/shikoku" },
    { name: "九州", lat: 32.78982, lng: 130.7417, url: "/region/kyushu" },
    { name: "沖縄", lat: 26.2124, lng: 127.6809, url: "/region/okinawa" }
];

  regions.forEach(r => {
    var labelIcon = L.divIcon({ className: '', html: `<div class="label-icon">${r.name}</div>`, iconSize: null });
    L.marker([r.lat, r.lng], { icon: labelIcon })
      .addTo(map)
      .on('click', function() { window.location.href = r.url; });
  });

  // 日本の輪郭をGeoJSONで描画
  fetch('https://raw.githubusercontent.com/dataofjapan/land/master/japan.geojson')
    .then(res => res.json())
    .then(data => {
      L.geoJSON(data, {
        style: {
          fillColor: '#f9f9f9',
          color: '#555',
          weight: 1
        }
      }).addTo(map);
    });
</script>

</body>
</html>