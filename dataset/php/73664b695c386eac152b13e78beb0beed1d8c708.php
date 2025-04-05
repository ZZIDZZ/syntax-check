public function populateFacts()
    {
        $this->facts = array();
        foreach ($this->providers as $provider) {
            $this->facts = array_replace_recursive($this->facts, $provider->getFacts());
        }
    }