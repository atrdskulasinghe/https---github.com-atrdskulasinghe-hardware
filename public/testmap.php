<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Location</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
  #map {
    height: 400px;
    width: 100%;
  }
</style>
</head>
<body>

<h2>Select Location</h2>
<div id="map"></div>

<form id="location-form" action="process_location.php" method="post">
  <input type="text" id="latitude" name="latitude">
  <input type="text" id="longitude" name="longitude">
  <button type="submit">Submit</button>
</form>

<script>
  var map = L.map('map').setView([6.9271, 79.8612], 13); // Set default view to Colombo, Sri Lanka

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  // Add a marker to the map when user clicks
  var marker;
  map.on('click', function(e) {
    if(marker) {
      map.removeLayer(marker);
    }
    marker = new L.Marker(e.latlng).addTo(map);
    document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
    document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
  });
</script>

</body>
</html>
