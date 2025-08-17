<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>日本</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      overflow: hidden; /* 横スクロール禁止 */
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
      height: 100vh; 
      width: 100%;
      max-width: 480px; /* iPhone画面幅に固定 */
      margin: 0 auto; 
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

<div class="title-header">
   <a href="{{ route('map') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i>
   </a>
   <h4>日本</h4>
</div>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('map', { 
    zoomControl: false,
    minZoom: 3,
    maxZoom: 10,
    dragging: false,  // ドラッグ不可
    scrollWheelZoom: false,
    doubleClickZoom: false,
    touchZoom: false
  }).setView([37, 137], 4); // 少し広げる

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // 地域ラベル
  var regions = [
    { name: "北海道", lat: 44.5, lng: 141.34694, url: "/region/hokkaido" },
    { name: "東北", lat: 40.3, lng: 140, url: "/region/tohoku" },
    { name: "関東", lat: 35.6895, lng: 139.6917, url: "/region/kanto" },
    { name: "北陸・東海", lat: 38, lng: 136.2529, url: "/region/hokuriku-tokai" }, // ← 緯度を36.8に上げた
    { name: "近畿", lat: 35.5, lng: 135.52, url: "/region/kinki" },
    { name: "中国", lat: 36, lng: 132.459, url: "/region/chugoku" },
    { name: "四国", lat: 33.84167, lng: 133.53111, url: "/region/shikoku" },
    { name: "九州", lat: 32.78982, lng: 130, url: "/region/kyushu" },
    { name: "沖縄", lat: 28.5, lng: 131.0, url: "/region/okinawa" }
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
      var offset = {lat: -5, lng: -3}; // 沖縄擬似配置
      var adjusted = JSON.parse(JSON.stringify(data));
      adjusted.features.forEach(f => {
        if(f.properties.NAME === "沖縄") {
          f.geometry.coordinates = f.geometry.coordinates.map(poly => 
            poly.map(ring => 
              ring.map(coord => [coord[0]+offset.lng, coord[1]+offset.lat])
            )
          );
        }
      });

      L.geoJSON(adjusted, {
        style: { fillColor: '#f9f9f9', color: '#555', weight: 1 }
      }).addTo(map);
    });
</script>

</body>
</html>