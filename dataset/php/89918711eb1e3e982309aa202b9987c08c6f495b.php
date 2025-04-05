public function getSql($formatted = false)
    {
        if ($formatted) {
            return $this->getBuilder()->writeFormatted($this);
        }

        return $this->getBuilder()->write($this);
    }