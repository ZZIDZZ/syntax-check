public function getOptions($server = null)
    {
        if (null === $server) {
            return $this->options;
        }

        $server = $this->getServer($server);

        return array_merge($this->options, $server->getOptions());
    }