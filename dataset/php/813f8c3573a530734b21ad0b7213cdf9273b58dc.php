public static function isValid($value)
    {
        try {
            $ISO3166 = new Alcohol\ISO3166();
            $ISO3166->getByAlpha2($value);
            return true;
        } catch (\DomainException $e) {
            return false;
        }
    }