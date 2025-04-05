protected function setup()
    {
        if (null === $this->identity) {
            throw new Exception\RuntimeException(
                'A value for the identity was not provided prior to authentication with ObjectRepository '
                . 'authentication adapter'
            );
        }

        if (null === $this->credential) {
            throw new Exception\RuntimeException(
                'A credential value was not provided prior to authentication with ObjectRepository'
                . ' authentication adapter'
            );
        }

        $this->authenticationResultInfo = array(
            'code' => AuthenticationResult::FAILURE,
            'identity' => $this->identity,
            'messages' => array()
        );
    }