public static function identifiable($value): bool
    {
        return $value instanceof UrlRoutable ||
            is_string($value) ||
            is_int($value) ||
            self::hash($value);
    }