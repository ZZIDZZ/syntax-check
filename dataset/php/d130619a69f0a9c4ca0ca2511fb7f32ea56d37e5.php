public function jsonRpc($inRequestUri, $inParameters=[]) {
        $bodyContent = json_encode($inParameters);

        // Prepare the request's headers.
        if (! array_key_exists('Content-Type', $this->__httpHeaders)) {
            $this->__httpHeaders['Content-Type'] = 'application/jsonrequest';
        }
        if (! array_key_exists('Accept', $this->__httpHeaders)) {
            $this->__httpHeaders['Accept'] = 'application/jsonrequest';
        }
        if (! array_key_exists('Content-Length', $this->__httpHeaders)) {
            $this->__httpHeaders['Content-Length'] = strlen($bodyContent);
        }
        return $this->request('POST', $inRequestUri, '', $bodyContent);
    }