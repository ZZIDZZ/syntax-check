private function getOption($name)
    {
        if (!isset($this->options[$name])) {
            throw new \InvalidArgumentException(sprintf('The option "%s" does not exist.', $name));
        }

        return $this->options[$name];
    }