public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return $this->domain . '/api/userinfo?access_token=' . $token;
    }