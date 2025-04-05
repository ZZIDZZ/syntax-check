public function getCustomerReference()
    {
        if (isset($this->data['response']['customer'])) {
            return $this->data['response']['customer'];
        }
        if (isset($this->data['response']['id'])) {
            return $this->data['response']['id'];
        }
    }