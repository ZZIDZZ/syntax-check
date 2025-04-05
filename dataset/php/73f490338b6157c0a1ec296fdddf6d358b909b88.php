private function handleResponse($response)
    {
        $statusCode = $response->getStatusCode();
        $body = json_decode($response->getBody());

        if ($statusCode >= 200 && $statusCode < 300) {
            return $body;
        }

        throw new \Exception($response->getBody(), $statusCode);
    }