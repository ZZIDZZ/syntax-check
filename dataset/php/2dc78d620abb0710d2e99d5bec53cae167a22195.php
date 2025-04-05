protected function isSupportedGeoIP2Model(string $method): bool
    {
        $availableMethods = [
            self::GEOIP2_MODEL_CITY,
            self::GEOIP2_MODEL_COUNTRY,
        ];

        return in_array($method, $availableMethods);
    }