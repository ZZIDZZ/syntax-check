public function isAjaxRequest()
    {
        // Check if ajax request
        {
            $ajaxRequest = $this->hasHeader('AjaxRequest');

            $serverParams = $this->getServerParams();
            if (!$ajaxRequest && !empty($serverParams['HTTP_X_REQUESTED_WITH']) && strtolower($serverParams['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $ajaxRequest = true;
            }
        }

        return $ajaxRequest;
    }