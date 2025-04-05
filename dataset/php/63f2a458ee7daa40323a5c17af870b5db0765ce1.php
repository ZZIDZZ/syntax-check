public function getDateValue($sFieldName, $sFormat = 'd.m.Y')
    {
        if(empty($sFieldName) || empty($sFormat)) {
            return null;
        }
        
        /** @var Carbon $obDate */
        $obDate = $this->$sFieldName;
        if(empty($obDate) || !$obDate instanceof Carbon) {
            return $obDate;
        }
        
        return $obDate->format($sFormat);
    }