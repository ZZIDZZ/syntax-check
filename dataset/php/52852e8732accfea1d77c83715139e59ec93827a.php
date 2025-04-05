public function getProtocolVersion()
    {
        if ($this->protocolVersion) {
            return $this->protocolVersion;
        }

        $protocolAndVersion = $_SERVER['SERVER_PROTOCOL'];
        list($protocol, $version) = explode('/', $protocolAndVersion);
        return $version;
    }