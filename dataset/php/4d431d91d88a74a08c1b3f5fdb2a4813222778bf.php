private function getDefaultKey()
    {
        if (isset($this->cache['defaultKey'])) {
            return $this->cache['defaultKey'];
        }
        $app = App::get();
        $cacheKey = 'ivopetkov-encryption-default-key';
        $value = $app->cache->getValue($cacheKey);
        if ($value === null) {
            $dataKey = 'encryption/default.key';
            $value = $app->data->getValue($dataKey);
            if ($value === null) {
                $value = md5(openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher)) . uniqid('', true) . rand(0, 999999999));
                $app->data->set($app->data->make($dataKey, $value));
            }
            $app->cache->set($app->cache->make($cacheKey, $value));
        }
        $this->cache['defaultKey'] = $value;
        return $value;
    }