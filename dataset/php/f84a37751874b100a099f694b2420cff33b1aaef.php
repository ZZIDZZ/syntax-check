public function setRemoteEndpoint(Endpoint $remoteEndpoint): void
    {
        $this->recorder->setRemoteEndpoint($this->traceContext, $remoteEndpoint);
    }