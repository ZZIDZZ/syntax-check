public function transforms($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException('A string is required');
        }
        if (false == preg_match('#^[a-zA-Z0-9]+$#', $string)) {
            throw new InvalidArgumentException('A valid string is required');
        }
        $inputs = [];
        $splitted = str_split($string);

        foreach ($splitted as $value) {
            $inputs[] = new Input($value);
        }

        return $inputs;
    }