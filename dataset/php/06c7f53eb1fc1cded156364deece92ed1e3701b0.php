public function create(HttpClient $client = null): PluginClient
    {
        return new PluginClient($client ?? HttpClientDiscovery::find(), $this->plugins);
    }