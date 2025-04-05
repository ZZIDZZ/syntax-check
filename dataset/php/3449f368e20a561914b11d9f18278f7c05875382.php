protected function setType($variable, $type)
    {
        // Do nothing if $type is not a string
        if (is_string($type)) {
            if (in_array($type, ['bool', 'boolean'])) {
                // Only 1, '1', true and 'true' values will be converted to boolean true
                // Any other value will be converted to boolean false
                $variable = in_array($variable, [1, '1', true, 'true'], true);
            } else {
                settype($variable, $type);
            }
        }

        return $variable;
    }