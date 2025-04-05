public static function asBoolean($data, $default = null)
    {
        $boolean = filter_var($data ?? [], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return ! is_null($boolean) ? $boolean : $default;
    }