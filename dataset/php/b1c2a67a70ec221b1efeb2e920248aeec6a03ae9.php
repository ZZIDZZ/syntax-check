protected function encrypt()
    {
        $this->hash = '';
        $hash_string = $this->secretKey."|".urlencode($this->parameters['account_id'])."|".urlencode($this->parameters['amount'])."|".urlencode($this->parameters['reference_no'])."|".$this->parameters['return_url']."|".urlencode($this->parameters['mode']);
        $this->hash = md5($hash_string);
    }