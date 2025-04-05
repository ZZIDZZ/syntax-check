protected function getConfig(string $name)
    {
        $connections = $this->app['config']['elasticsearch.connections'];

        if (null === $config = array_get($connections, $name)) {
            throw new \InvalidArgumentException("Elasticsearch connection [$name] not configured.");
        }

        return $config;
    }