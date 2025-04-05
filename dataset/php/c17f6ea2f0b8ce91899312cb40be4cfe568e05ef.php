protected function _createNew($className)
    {
        if (!empty($this->objects[$className])) {
            return array_shift($this->objects[$className]);
        }

        if (class_exists($className) == false) {
            throw new ClassNotFoundException('The class '.$className.' cannot be found');
        }

        $constructArguments = func_get_args();
        array_shift($constructArguments);
        return new $className( ...$constructArguments);
    }