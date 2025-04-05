protected function readProperty($object, $property)
    {
        foreach ($this->propertyReader as $reader) {
            /** @var PropertyReaderInterface $reader */
            if ($reader->supports($object, $property)) {
                return $reader->getValue($object, $property);
            }
        }

        $camelProp = ucfirst($property);
        $getter = 'get'.$camelProp;
        $isser = 'is'.$camelProp;

        if (method_exists($object, $getter)) {
            return $object->$getter();
        } elseif (method_exists($object, $isser)) {
            return $object->$isser();
        } elseif (property_exists($object, $property)) {
            $reflectionProperty = new \ReflectionProperty($object, $property);
            $reflectionProperty->setAccessible(true);

            return $reflectionProperty->getValue($object);
        }

        throw new InvalidPropertyException(sprintf('Neither property "%s" nor method "%s()" nor method "%s()" exists in class "%s"', $property, $getter, $isser, get_class($object)));
    }