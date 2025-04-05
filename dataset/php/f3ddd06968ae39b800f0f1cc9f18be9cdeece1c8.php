private function getDecParams()
    {
        // Parametri obbligatori
        $params = array(
            'shopLogin' => $this->getShopLogin(),
            'CryptedString' => $this->getEncryptedString(),
        );

        return array_merge($params, $this->getOptParams());
    }