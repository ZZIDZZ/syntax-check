public function sendData($data)
    {
        $xml = $this->buildRequest($data);
        
        $headers = array(
            'content-type' => 'text/xml; charset=utf-8',
            'SOAPAction' => 'https://gateway.agms.com/roxapi/ProcessTransaction'
        );

        $httpResponse =  $this->httpClient->post($this->getEndpoint(), $headers, $xml)->send();
        return $this->response = new Response($this, $httpResponse->getBody());
    }