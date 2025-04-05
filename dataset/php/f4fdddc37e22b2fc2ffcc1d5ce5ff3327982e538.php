public function removeMethodByName($name)
    {
        foreach ($this->methods as $key => $method) {
            if ($method->getName() == $name) {
                unset($this->methods[$key]);
                return;
            }
        }

        throw new \InvalidArgumentException(sprintf('The method "%s" does not exists.', $name));
    }