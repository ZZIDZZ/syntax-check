public function getBoundary()
    {
        if (empty($this->_boundary)) {
            $this->_boundary = '--' . md5('PEAR-HTTP_Request2-' . microtime());
        }
        return $this->_boundary;
    }