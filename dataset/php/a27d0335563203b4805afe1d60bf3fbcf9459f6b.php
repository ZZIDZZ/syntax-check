private static function getExtraKey($key, $fallback)
    {
        static $autosplitter = null;

        if (null === $autosplitter) {
            $autosplitter = isset(self::$extra[self::EXTRA_KEY])
                ? self::$extra[self::EXTRA_KEY]
                : array();
        }

        return isset($autosplitter[$key]) ? $autosplitter[$key] : $fallback;
    }