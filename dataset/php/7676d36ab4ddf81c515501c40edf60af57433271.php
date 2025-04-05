private function getPropertyName($methodName)
    {
        $pattern = implode('|', array_merge(self::$accessorPrefixes, self::$mutatorPrefixes));

        if (preg_match('/^('.$pattern.')(.+)$/i', $methodName, $matches)) {
            return $matches[2];
        }
    }