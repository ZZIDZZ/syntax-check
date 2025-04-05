protected function validate($value)
    {
        $value = trim($value);

        if ($value === '') {
            throw new EmptyValueNotAllowedException($this->getValueName());
        }

        return $value;
    }