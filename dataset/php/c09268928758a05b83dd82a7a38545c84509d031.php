protected function getUriBuilder(): UriBuilder
    {
        if ($this->uriBuilder !== null) {
            return $this->uriBuilder;
        }

        $httpRequest = Request::createFromEnvironment();
        $actionRequest = new ActionRequest($httpRequest);
        $this->uriBuilder = new UriBuilder();
        $this->uriBuilder
            ->setRequest($actionRequest);
        $this->uriBuilder
            ->setFormat('html')
            ->setCreateAbsoluteUri(false);

        return $this->uriBuilder;
    }