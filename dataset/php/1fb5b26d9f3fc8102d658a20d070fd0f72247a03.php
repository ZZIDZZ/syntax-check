protected function checkStrictness(ContainerResult $container, $object): void
    {
        $properties = $this->getProperties();
        foreach ($object as $property => $value) {
            if (array_key_exists($property, $properties) === false) {
                $container->addResult(
                    $this->getInvalidResult(self::PROPERTY_NOT_ALLOWED, [
                        'property' => $property,
                    ]),
                    $property
                );
            }
        }
    }