public function listChannelSections($parameters)
    {
        $this->apiUri   = $this->baseUri . '/channelSections';
        $this->filters  = [
            'channelId',
            'id',
        ];

        if (empty($parameters) || !isset($parameters['part'])) {
            throw new \InvalidArgumentException(
                'Missing the required "part" parameter.'
            );
        }

        $response = $this->callApi($parameters);

        return json_decode($response, true);
    }