protected function applyConditions($expression, $conditions)
    {
        $search = $replace = [];

        foreach ($conditions as $key => $value) {
            $search[]  = "<$key>" . self::STRVAL;
            $replace[] = "<$key>$value";
        }

        return str_replace($search, $replace, $expression);
    }