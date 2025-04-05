public function getProvider($name)
    {
        if (!$this->hasProvider($name)) {
            throw new \RuntimeException(sprintf('Unable to retrieve the provider named: "%s"', $name));
        }

        return $this->providers[$name];
    }