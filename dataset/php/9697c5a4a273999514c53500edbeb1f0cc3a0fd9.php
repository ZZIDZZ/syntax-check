protected function generateKey($key)
    {
        $keySize = openssl_cipher_iv_length(static::CRYPT_MODE);
        $key     = hash(
            'SHA256', $this->options->getClassName() . ':' . $this->sessionName . ':' . $key, true
        );

        return substr($key, 0, $keySize);
    }