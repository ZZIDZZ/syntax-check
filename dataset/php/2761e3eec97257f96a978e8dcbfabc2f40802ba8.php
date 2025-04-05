public function getParameters()
    {
        $bodyParams = json_decode($this->body, true);
        if (!$bodyParams) {
            return array();
        }

        $parameters = array();
        foreach ($bodyParams as $paramName => $paramValue) {
            $parameters[$paramName] = $paramValue;
        }

        return $parameters;
    }