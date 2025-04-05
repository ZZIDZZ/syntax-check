public function get($resource, $headers = array())
    {
        return $this->getGuzzle()->request(
          'GET',
          $this->getUrl().$resource,
          ['headers' => array_merge($this->getHeaders(), $headers)]
        );
    }