<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>世界地図</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      overflow: hidden;
    }
    #map {
      height: 70vh;   /* ← iPhone用に全体を縮小 */
      width: 100%;
    }
    .title-header {
      position: relative;
      width: 100%;
      height: 50px;
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      z-index: 1000;
      background: #fff;
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
  <a href="{{ route('home') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i>
  </a>
  <h4>世界地図</h4>
</div>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // --- 地図の初期設定（日本を中心） ---
  var map = L.map('map', {
    minZoom: 1,   // ← さらに引けるように
    maxZoom: 5,
    zoomSnap: 0.1,
    zoomControl: false,
    worldCopyJump: true
  }).setView([30, 140], 2); // ← ズーム縮小

  // --- OpenStreetMap タイル ---
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    noWrap: false
  }).addTo(map);

  // --- マーカー ---
  var locations = [
    { name: "日本", lat: 35.6762, lng: 139.6503, url: "/japan" },
    { name: "アジア", lat: 34.0479, lng: 100.6197, url: "/asia" },
    { name: "欧州", lat: 48.8566, lng: 2.3522, url: "/europe" },
    { name: "北米", lat: 37.0902, lng: -95.7129 + 360, url: "/north-america" }, 
    { name: "中南米", lat: -14.2350, lng: -51.9253 + 360, url: "/latin-america" },
    { name: "アメリカ", lat: 38.9072, lng: -77.0369 + 360, url: "/usa" },
    { name: "中東", lat: 25.276987, lng: 55.296249, url: "/middle-east" },
    { name: "アフリカ", lat: 1.6508, lng: 10.2679, url: "/africa" },
    { name: "大洋州", lat: -25.2744, lng: 133.7751, url: "/oceania" }
  ];

  locations.forEach(loc => {
    var labelIcon = L.divIcon({
      className: '',
      html: `<div class="label-icon">${loc.name}</div>`,
      iconSize: null
    });
    L.marker([loc.lat, loc.lng], { icon: labelIcon })
      .addTo(map)
      .on('click', function() { window.location.href = loc.url; });
  });

</script>

</body>
</html>