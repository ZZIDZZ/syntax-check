public static function formatValues(array $values)
    {
        foreach ($values as $key => $value) {
            $values[$key] = self::formatValue($value);
        }

        return $values;
    }