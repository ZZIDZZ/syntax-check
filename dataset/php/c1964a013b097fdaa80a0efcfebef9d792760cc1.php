public function getAll()
    {
        // build url
        $url = $this->base_url . $this->url;
        // get data from server
        $data = $this->getDataFromUrl($url);
        // parse result set and get data as array
        $result = $this->parseJsonData($data);
        
        return $result;
    }