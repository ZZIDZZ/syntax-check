public static function keyExists(array $array, $key)
    {
        if (($pos = strrpos($key, '.')) !== false
            && ($subKey = substr($key, 0, $pos)) !== false
            && static::keyExists($array, $subKey)
            && static::keyExists($array[$subKey], substr($key, $pos + 1))
        ) {
            return true;
        }

        return (isset($array[$key]) || array_key_exists($key, $array));
    }