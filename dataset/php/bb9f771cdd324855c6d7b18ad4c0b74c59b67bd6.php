public function setCode($code)
    {
        $this->code = (int) $code;

        return $this->mergeData([static::codeKey() => $this->code]);
    }