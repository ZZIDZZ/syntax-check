public function record(RequestInterface $request, ResponseInterface $response, float $duration = null): void
    {
        $this->addEntry(new Entry($request, $response, $duration));
    }