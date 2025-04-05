public function getGPX()
    {
        // @TODO use some library to generate GPX files
        $xml = new \SimpleXMLElement(
            '<gpx xmlns="http://www.topografix.com/GPX/1/1" '
            . 'xmlns:gpxtpx="http://www.garmin.com/xmlschemas/TrackPointExtension/v1" '
            . '/>'
        );
        $trk = $xml->addChild('trk');
        $trk->addChild('type', str_replace(', ', '_', strtoupper($this->getTypeName())));
        $trkseg = $trk->addChild('trkseg');

        foreach ($this->getPoints() as $point) {
            $trkpt = $trkseg->addChild('trkpt');
            $trkpt->addChild('time', $point->getTime()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z'));
            $trkpt->addAttribute('lat', $point->getLatitude());
            $trkpt->addAttribute('lon', $point->getLongitude());

            if ($point->getAltitude() !== null) {
                $trkpt->addChild('ele', $point->getAltitude());
            }

            if ($point->getHeartRate() !== null) {
                $ext = $trkpt->addChild('extensions');
                $trackPoint = $ext->addChild('gpxtpx:TrackPointExtension', '', 'gpxtpx');
                $trackPoint->addChild('gpxtpx:hr', $point->getHeartRate(), 'gpxtpx');
            }
        }

        return $xml->asXML();
    }