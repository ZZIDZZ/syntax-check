public function fetchToken($authorizationCode)
    {
        $additionalParams = [
            'code' => $authorizationCode,
            'redirect_uri' => $this->configuration->getRedirectUrl(),
        ];

        $response = parent::fetchAccessToken('authentication/v1/gettoken', 'authorization_code', $additionalParams);

        $this->saveRefreshToken($response);
    }