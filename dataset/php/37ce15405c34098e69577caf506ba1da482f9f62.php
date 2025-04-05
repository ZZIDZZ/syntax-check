public static function isSuccessful($code)
    {
        switch($code) {
            case self::HTTP_OK:
            case self::HTTP_CREATED:
            case self::HTTP_ACCEPTED:
            case self::HTTP_NONAUTHORITATIVE_INFORMATION:
            case self::HTTP_NO_CONTENT:
            case self::HTTP_RESET_CONTENT:
            case self::HTTP_PARTIAL_CONTENT:
                return true;
            default:
                return false;
        }
    }