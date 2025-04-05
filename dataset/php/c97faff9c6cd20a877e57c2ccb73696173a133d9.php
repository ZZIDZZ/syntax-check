public static function generateCacheKeys()
    {
        $args = func_get_args();
        if (empty($args)) {
            throw new \InvalidArgumentException('At least one argument must be passed to generate cache key.');
        }
        $ids = array_pop($args);
        if (!is_array($ids)) {
            throw new \InvalidArgumentException('The last parameter must be an array.');
        }
        $commonKey = call_user_func_array(['self', 'generateCacheKey'], $args);
        $result = [];
        foreach ($ids as $id) {
            $result[] = $commonKey . self::$delimiter . $id;
        }
        return $result;
    }