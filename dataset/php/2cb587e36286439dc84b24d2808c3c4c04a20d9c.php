private function status(
        ResponseInterface $response,
        PayloadInterface $payload
    ) {
        $status = $payload->getStatus();
        $code = $this->http_status->getStatusCode($status);

        return $response->withStatus($code);
    }