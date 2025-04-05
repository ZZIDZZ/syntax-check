public static function humanize($name)
    {
        if (empty($name)) {
            return '';
        }
        $word = static::tableize(static::classify($name), ' ');
        $word = strtoupper($word[0]) . substr($word, 1);
        return $word;
    }