public static function call($path, $assoc = false)
    {
        return self::parse(BomUtil::removeBom(self::readFile($path)), $assoc);
    }