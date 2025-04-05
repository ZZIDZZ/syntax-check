public function has($composite_key)
    {
        $array_keys = explode($this->separator, $composite_key);
        $container = $this->container;
        
        foreach ($array_keys as $key) {
            if (!$this->hasChild($container, $key)) {
                return false;
            }
            $container = $this->getChild($container, $key);
        }
        return true;
    }