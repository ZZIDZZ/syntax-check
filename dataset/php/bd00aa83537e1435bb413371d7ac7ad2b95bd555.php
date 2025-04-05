public function getProvider($command)
    {
        return (isset($this->validProviders[$command])) ? $this->validProviders[$command] : false;
    }