public function reflash(array $keys = null): self
    {
        if ($keys === null) {
            return $this->clear($this->data + $this->session);
        }

        $session = array_intersect_key($this->session, array_flip($keys));
        return $this->clear($this->data + $session);
    }