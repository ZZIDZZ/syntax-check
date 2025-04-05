private function prepare(): void
    {
        if ($this->request == null) {
            $this->request = ServerRequestFactory::fromGlobals();
        }

        if ($this->publisher == null) {
            $this->publisher = new Publisher();
        }
    }