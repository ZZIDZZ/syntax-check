protected static function checkType(array $allowedTypes, $type, $value)
    {
        if (count($allowedTypes) && !in_array($type, $allowedTypes)) {
            $allowed = implode(', ', $allowedTypes);
            throw new \InvalidArgumentException(
                "Expected one of: $allowed; got $type"
            );
        }

        return $value;
    }