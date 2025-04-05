private function parseSignature(array $header, string $data): Signature
    {
        if ($data === '' || ! isset($header['alg']) || $header['alg'] === 'none') {
            return Signature::fromEmptyData();
        }

        $hash = $this->decoder->base64UrlDecode($data);

        return new Signature($hash, $data);
    }