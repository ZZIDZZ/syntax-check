public static function cursorToOffsetWithDefault($cursor, $default, $array = [])
    {
        if (!is_string($cursor)) {
            return $default;
        }

        $key = self::cursorToKey($cursor);
        if (empty($array)) {
          $offset = $key;
        }
        else {
          $offset = array_search($key, array_keys($array));
        }

        return is_null($offset) ? $default : (int) $offset;
    }