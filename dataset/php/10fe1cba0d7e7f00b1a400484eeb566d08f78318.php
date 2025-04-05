public function getB2BFamily()
    {
        $client = $this->getClient();

        return new B2BFamily($client,
            $this->config->get('amocrm.b2bfamily.appkey'),
            $this->config->get('amocrm.b2bfamily.secret'),
            $this->config->get('amocrm.b2bfamily.email'),
            $this->config->get('amocrm.b2bfamily.password')
        );
    }