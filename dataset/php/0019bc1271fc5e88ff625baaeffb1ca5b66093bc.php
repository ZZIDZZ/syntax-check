public function registerProvider(TextingProviderInterface $provider)
    {
        if (!$this->defaultProvider) {
            $this->defaultProvider = &$provider;
        }

        $this->providers[$provider->getName()] = $provider;
    }