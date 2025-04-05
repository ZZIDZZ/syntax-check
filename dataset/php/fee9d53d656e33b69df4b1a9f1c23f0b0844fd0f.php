public function setFromArray($options)
    {

        if ($options instanceof self) {
            $options = $options->toArray();
        }

        if (!is_array($options) && !$options instanceof Traversable) {
            throw new InvalidArgumentException(sprintf(
                'Parameter provided to %s must be an %s, %s or %s',
                __METHOD__,
                'array',
                'Traversable',
                'Zend\Stdlib\AbstractOptions'
            ));
        }

        foreach ($options as $key => $value) {
            $this->__set($key, $value);
        }

        return $this;
    }