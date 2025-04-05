public function withStatus($code, $reason_phrase = '')
    {
        if (!in_array($code, array_keys($this->status_codes))) {
            throw new InvalidArgumentException(
                'HTTP Status Code is invalid'
            );
        }

        $response = clone $this;
        $response->status_code = (int)$code;
        $response->reason_phrase = (string)$reason_phrase ?? $this->status_code[$code];

        return $response;
    }