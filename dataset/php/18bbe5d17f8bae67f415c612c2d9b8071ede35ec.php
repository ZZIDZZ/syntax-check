public static function upper($string)
    {
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($string, static::getEncoding());
        }

        return static::replaceByMap($string, static::$cyrillicAlphabet[1], static::$cyrillicAlphabet[0]);
    }