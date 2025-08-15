<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>世界地図（日本中心・右にアメリカ）</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map { height: 100vh; width: 100%; max-width: 1000px; margin: 0 auto; }
    .map-title { position: absolute; top: 10px; left: 50%; transform: translateX(-50%);
      background: white; padding: 6px 12px; border-radius: 5px; font-size: 18px; font-weight: bold; z-index: 1000; }
    .back-button { position: absolute; top: 10px; left: 10px; background: #eee;
      padding: 6px 10px; border-radius: 5px; cursor: pointer; z-index: 1000; }
    .label-icon { background: white; border: 1px solid #555; border-radius: 4px; padding: 2px 5px;
      font-size: 12px; font-weight: bold; white-space: nowrap; }
  </style>
</head>
<body>

<div class="map-title">世界地図</div>
<div class="back-button" onclick="window.location='/home'">← 戻る</div>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // 地図の初期設定
  var map = L.map('map', { worldCopyJump: true, minZoom: 1.9, zoomSnap: 0.1 })
    .setView([20, 140], 1.9);

  // タイルレイヤー
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // マーカー情報
  var locations = [
    { name: "日本", lat: 35.6762, lng: 139.6503, url: "/region/japan" },
    { name: "アジア", lat: 34.0479, lng: 100.6197, url: "/region/asia" },
    { name: "欧州", lat: 48.8566, lng: 2.3522, url: "/region/europe" },
    { name: "北米", lat: 37.0902, lng: -95.7129 + 360, url: "/region/northAmerica" },
    { name: "中南米", lat: -14.2350, lng: -51.9253 + 360, url: "/region/latinAmerica" },
    { name: "アメリカ", lat: 38.9072, lng: -77.0369 + 360, url: "/region/usa" },
    { name: "中東", lat: 25.276987, lng: 55.296249, url: "/region/middleEast" },
    { name: "アフリカ", lat: 1.6508, lng: 10.2679, url: "/region/africa" },
    { name: "大洋州", lat: -25.2744, lng: 133.7751, url: "/region/oceania" }
  ];

  // マーカー追加
  locations.forEach(loc => {
    var labelIcon = L.divIcon({ className: '', html: `<div class="label-icon">${loc.name}</div>`, iconSize: null });
    L.marker([loc.lat, loc.lng], { icon: labelIcon })
      .addTo(map)
      .on('click', function() { window.location.href = loc.url; });
  });

  // 表示範囲制限
  var bounds = [[-80, 40], [85, 280]];
  map.setMaxBounds(bounds);
  map.on('drag', function() { map.panInsideBounds(bounds, { animate: false }); });

  // サイズ調整
  setTimeout(() => map.invalidateSize(), 200);
</script>

</body>
</html>
