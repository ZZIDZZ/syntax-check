public final function __isset(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new PropertyTraitException(sprintf('Property %s::$%s does not exist',
                static::class, $name));
        }

        return ($this->{$name} !== null);
    }