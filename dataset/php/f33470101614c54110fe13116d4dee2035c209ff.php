protected function generateResponseForRequest($request = null)
    {
        $leafClass = $this->getLeafClassName();

        if ($this->isCollection()) {
            $leaf = new $leafClass($this->getModelCollection());
        } else {
            if (is_callable($leafClass)){
                $leaf = $leafClass($this, $this->getModelObject());
            } else {
                $leaf = new $leafClass($this->getModelObject());
            }
        }

        $response = $leaf->generateResponse($request);

        if (is_string($response)) {
            $htmlResponse = new HtmlResponse($leaf);
            $htmlResponse->setContent($response);
            $response = $htmlResponse;
        }

        return $response;
    }