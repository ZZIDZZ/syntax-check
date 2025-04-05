public function add($object)
    {
        $className = '\\' . get_class($object);

        if ($this->injectSelf($className)) {
            throw new InvalidArgumentException('Tried to add a container instance');
        }

        $parameterKey = $this->getParameterStoreKey([]);

        if (isset($this->services[$className][$parameterKey])) {
            throw new InvalidArgumentException('Tried to add a service instance which already exists');
        }

        $this->services[$className][$parameterKey] = $object;
    }