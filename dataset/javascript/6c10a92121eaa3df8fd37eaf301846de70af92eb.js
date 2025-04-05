function generateDestinationLonLat ({
  lat,
  lon
}) {
  const latOffset = (getDistance() / LAT_DEGREE) * getSign()
  const lonOffset = (getDistance() / (LAT_DEGREE * Math.cos(lat))) * getSign()
  return {
    lat: lat + latOffset,
    lon: lon + lonOffset
  }
}