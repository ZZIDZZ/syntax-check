public function addModifier($modifier)
    {
        if (strpos($this->modifiers, $modifier) === false) {
            $this->modifiers .= $modifier;
        }

        return $this;
    }