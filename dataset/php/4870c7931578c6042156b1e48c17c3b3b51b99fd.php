protected function setLength($length)
    {
        if ($length === null) {
            $length = self::DEFAULT_LENGTH;
        }

        $this->length = $length;
    }