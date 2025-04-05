private function getData($url)
    {
        try {
            $request = $this->client->get($url);
            $response = $request->send();
            $decoder = new JsonDecode(true);
            $data = $decoder->decode($response->getBody(true), 'json');
            if (isset($data['links']['next'])) {
                $next = $this->getData($data['links']['next']);
                $data['entries'] = array_merge($data['entries'], $next['entries']);
            }
        } catch (\Exception $e) {
            $data = array();
        }

        return $data;
    }