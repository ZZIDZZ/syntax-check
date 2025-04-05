public function getApi()
    {
        if (is_null($this->api)) {
            $this->api = new AES();
            $this->api->setKey($this->getKey());
        }
        
        return $this->api;
    }