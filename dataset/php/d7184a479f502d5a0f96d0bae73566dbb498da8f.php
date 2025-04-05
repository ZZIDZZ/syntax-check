protected function getInstanceOf($classname)
    {
        // As of PHP5.4 the reflection api provides a way to get an instance
        // of a class without invoking the constructor.
        if (method_exists('ReflectionClass', 'newInstanceWithoutConstructor')) {
            $reflectedClass = new \ReflectionClass($classname);

            return $reflectedClass->newInstanceWithoutConstructor();
        }

        // Use a trick to create a new object of a class
        // without invoking its constructor.
        return unserialize(
            sprintf(
                'O:%d:"%s":0:{}', strlen($classname), $classname
            )
        );
    }