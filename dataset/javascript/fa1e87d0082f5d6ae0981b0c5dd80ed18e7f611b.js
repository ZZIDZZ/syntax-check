function addToMap(location, map) {
    var marker = L.marker(location.coordinates);
    marker.addTo(map);
  }