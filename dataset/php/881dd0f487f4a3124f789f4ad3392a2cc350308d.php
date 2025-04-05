public function getConfig()
    {
        if (!isset($config)) {
            $this->config = $this->getServiceLocator()->get('FzyCommon\Config');
        }

        return $this->config;
    }