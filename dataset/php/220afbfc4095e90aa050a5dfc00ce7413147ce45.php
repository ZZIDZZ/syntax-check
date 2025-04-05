protected function _readAndThrowException($length)
    {
        $data = @stream_get_contents($this->_socket, $length);

        $info = stream_get_meta_data($this->_socket);
        if ($info['timed_out']) {
            throw new Rediska_Connection_TimeoutException("Connection read timed out.");
        }

        if ($data === false) {
            $this->disconnect();
            throw new Rediska_Connection_Exception("Can't read from socket.");
        }

        return $data;
    }