public function send(): bool
    {
        $response = $this->client->request(
            'POST',
            $this->client->getConfig('base_uri')->getPath(),
            $this->buildPayload()
        );

        return $response->getStatusCode() === 200;
    }