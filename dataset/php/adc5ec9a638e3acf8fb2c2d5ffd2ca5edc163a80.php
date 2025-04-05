function collect()
    {
        return [
            'content-type' => $this->response->header('Content-Type'),
            'status_code' => $this->response->getStatus(),
            'headers' => $this->getDataFormatter()->formatVar($this->response->headers->all()),
            'cookies' => $this->getDataFormatter()->formatVar($this->response->cookies->all()),
        ];
    }