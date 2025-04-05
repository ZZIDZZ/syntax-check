private function parseClasses()
    {
        if ($this->classes->count() > 0) {
            $this->attributes->put('class', implode(' ', $this->classes->all()));
        }

        return $this;
    }