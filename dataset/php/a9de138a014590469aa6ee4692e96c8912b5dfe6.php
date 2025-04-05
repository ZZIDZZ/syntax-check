private function setCode($code)
    {
        if (!\is_numeric($code)) {
            throw InvalidStatusCodeException::notNumeric($code);
        }
        $code = (int) $code;

        if ($code < 100) {
            throw InvalidStatusCodeException::notGreaterOrEqualTo100($code);
        }
        $this->code = $code;
    }