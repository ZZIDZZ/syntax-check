public function setTypesAllowed($allowedTypes = null)
    {
        if (!$this->isLatest()) {
            return $this->setAllowedTypes($allowedTypes);
        }

        foreach ($allowedTypes as $option => $typesAllowed) {
            $this->setAllowedTypes($option, $typesAllowed);
        }

        return $this;
    }