public function getLatLng()
    {
        $oLatLng = new \stdClass();
        $oLatLng->lat = $this->sLat;
        $oLatLng->lng = $this->sLng;

        return $oLatLng;
    }