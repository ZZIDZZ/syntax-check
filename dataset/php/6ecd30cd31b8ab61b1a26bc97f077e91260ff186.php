public function completeFlow(ClientEntity $client)
    {
        // Validate the auth code
        $authCode = $this->server->getRequestHandler()->getParam('code');
        if (is_null($authCode)) {
            throw new Exception\InvalidRequestException('code');
        }

        $code = $this->server->getAuthCodeStorage()->get($authCode);
        if (($code instanceof AuthCodeEntity) === false) {
            throw new Exception\InvalidRequestException('code');
        }

        // Ensure the auth code hasn't expired
        if ($code->isExpired() === true) {
            throw new Exception\InvalidRequestException('code');
        }

        // Check redirect URI presented matches redirect URI originally used in authorize request
        if ($code->getRedirectUri() !== $client->getRedirectUri()) {
            throw new Exception\InvalidRequestException('redirect_uri');
        }

        $session = $code->getSession();
        $session->associateClient($client);

        $authCodeScopes = $code->getScopes();

        // Generate the access token
        $accessToken = new AccessTokenEntity($this->server);
        $accessToken->setId();
        $accessToken->setExpireTime($this->getAccessTokenTTL() + time());

        foreach ($authCodeScopes as $authCodeScope) {
            $session->associateScope($authCodeScope);
        }

        foreach ($session->getScopes() as $scope) {
            $accessToken->associateScope($scope);
        }

        $this->server->getTokenType()->setSession($session);
        $this->server->getTokenType()->setParam('access_token', $accessToken->getId());
        $this->server->getTokenType()->setParam('expires_in', $this->getAccessTokenTTL());

        // Associate a refresh token if set
        if ($this->server->hasGrantType('refresh_token')) {
            $refreshToken = new RefreshTokenEntity($this->server);
            $refreshToken->setId();
            $refreshToken->setExpireTime($this->server->getGrantType('refresh_token')->getRefreshTokenTTL() + time());
            $this->server->getTokenType()->setParam('refresh_token', $refreshToken->getId());
        }

        // Expire the auth code
        $code->expire();

        // Save all the things
        $accessToken->setSession($session);
        $accessToken->save();

        if (isset($refreshToken) && $this->server->hasGrantType('refresh_token')) {
            $refreshToken->setAccessToken($accessToken);
            $refreshToken->save();
        }

        return $this->server->getTokenType()->generateResponse();
    }