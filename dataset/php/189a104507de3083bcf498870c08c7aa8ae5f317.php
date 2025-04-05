public static function getUnset (&$arr, $key, $default = null)
    {
        $value                  = isset($arr[$key]) ? $arr[$key] : $default;
        if (isset($arr[$key]))
            unset($arr[$key]);
        return $value;
    }