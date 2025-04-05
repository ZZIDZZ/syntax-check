public function rebase($base)
    {
        return new static([
            'scheme' => $this->scheme,
            'user' => $this->user,
            'pass' => $this->password,
            'host' => $this->host,
            'port' => $this->port,
            'base' => $base,
            'path' => $this->path,
            'query' => $this->query,
            'fragment' => $this->fragment,
        ]);
    }