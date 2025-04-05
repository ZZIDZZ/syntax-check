public function sign(array $params)
    {
        $base64DecodedKey = base64_decode($this->options['secret_key']);
        $key = $this->encrypt_3DES($params['Ds_Merchant_Order'],
            $base64DecodedKey);

        $res = $this->mac256(
            $this->createMerchantParameters($params),
            $key
        );

        return base64_encode($res);
    }