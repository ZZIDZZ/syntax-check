public static function checkValue($value, $type)
    {
        $validator = is_callable($type) ? $type : (isset(self::$validators[$type]) ? self::$validators[$type] : null);

        if (!is_null($value)) {
            return call_user_func($validator, $value);
        }

        return false;
    }