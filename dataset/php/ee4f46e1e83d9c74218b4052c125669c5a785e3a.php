protected function _validateDateFormat($attribute, $value, $parameters)
    {
        $this->_requireParameterCount(1, $parameters, 'date_format');

        if (! is_string($value)) {
            return false;
        }

        $parsed = date_parse_from_format($parameters[0], $value);

        return $parsed['error_count'] === 0 && $parsed['warning_count'] === 0;
    }