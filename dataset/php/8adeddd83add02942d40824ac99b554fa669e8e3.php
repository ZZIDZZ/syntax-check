public function getProperties($filter = null)
    {
        $args = func_get_args();
        $properties = ReflectionProperty::factory($this->name);

        if (count($args)) {
            return $this->filter($properties, current($args));
        }

        return $properties;
    }