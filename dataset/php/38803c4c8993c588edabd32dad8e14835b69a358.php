private function _receiveResponse($removeId = false, $readUntil = "\n")
    {
        $result = null;
        $readUntilLen = strlen($readUntil);
        do {
            if ($this->_socket->selectRead($this->_timeout)) {
                $rt = $this->_socket->read(4096, $this->_mode);
                if ($rt === "") {
                    break;
                }
                $result .= $rt;
                if (strcmp(substr($result, 0 - $readUntilLen), $readUntil) == 0) {
                    break;
                }
            } else if ($this->_mode === PHP_NORMAL_READ) {
                throw new ConnectionException("Timeout waiting to read response");
            } else {
                break;
            }
        } while (true);

        if (!$this->_inSession) {
            $this->_closeConnection();
        } else if ($removeId) {
            $result = preg_replace('/^\d+: /', "", $result, 1);
        }

        return trim($result);
    }