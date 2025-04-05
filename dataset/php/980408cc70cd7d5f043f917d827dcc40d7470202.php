protected static function jsonUnserializeFromProperties($properties)
    {
        if ( ! is_array($properties) && ! is_object($properties)) {
            throw UnserializationException::invalidProperty('Named CRS', 'properties', $properties, 'array or object');
        }

        $properties = new \ArrayObject($properties);

        if ( ! $properties->offsetExists('name')) {
            throw UnserializationException::missingProperty('Named CRS', 'properties.name', 'string');
        }

        $name = (string) $properties['name'];

        return new self($name);
    }