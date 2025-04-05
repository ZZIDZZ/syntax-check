public function account($segment, array $parameters=[]) {
        $baseUrl = $this->accountUrl;
        return $this->nonPublicRequest($baseUrl, $segment, $parameters);
    }