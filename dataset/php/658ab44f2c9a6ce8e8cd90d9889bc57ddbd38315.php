public function setUpContext()
    {
        return $this->context = (new \NetLicensing\Context())
            ->setBaseUrl(self::BASE_URL)
            ->setSecurityMode(self::SECURITY_MODE)
            ->setUsername(self::USERNAME)
            ->setPassword(self::PASSWORD);
    }