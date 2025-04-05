public function add(array $objects)
    {
        foreach ($objects as $name => $value) {
            $this->_objects[$name] = $value;
        }
    }