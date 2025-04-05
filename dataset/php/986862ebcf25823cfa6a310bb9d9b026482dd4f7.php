public function setIpAddress($ip, $port = 80) {
        if (false !== strpos($ip, ':')) {
            list($ip, $port) = explode(':', $ip);
        }
        if (empty($ip)) {
            $ip = '127.0.0.1';
        }
        $this->ip = $ip;
        $this->port = intval($port);
        return $this;
    }