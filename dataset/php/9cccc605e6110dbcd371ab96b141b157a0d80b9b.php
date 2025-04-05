public static function log(string $message, string $level = self::LEVEL_INFO, ?string $category = null, $dump = null)
    {
        $message = Text::crop($message, 255);
        return static::getAdapter()->log($message, $level, $category, $dump);
    }