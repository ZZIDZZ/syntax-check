public function getStorageValue() 
    {
        if ($this->isValid() === true && ($this->value !== undefined || $this->default !== undefined)) {
            return $this->internal_ProccessGet($this->value, false);
        } else {
            if ($this->isCollection() === true) {
                return [];
            } else {
                return null;
            }
        }
    }