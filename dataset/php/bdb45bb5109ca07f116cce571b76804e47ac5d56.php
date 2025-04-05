public static function search($array, $value, $strict = false, $prepend = '', $default = null)
    {
        foreach ($array as $key => $_value_)
        {
            $key = $prepend === '' ? $key : $prepend.'.'.$key;

            if (($strict && $_value_ === $value) || ( ! $strict && $_value_ == $value))
            {
                return $key;
            }

            if (is_array($_value_) || $_value_ instanceof \Traversable)
            {
                $found = static::search($_value_, $value, $strict, $key, $default);

                if ($found === $default) continue;

                return $found;
            }
        }

        return $default;
    }