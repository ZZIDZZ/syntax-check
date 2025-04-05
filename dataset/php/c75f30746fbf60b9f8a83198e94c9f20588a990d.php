private function getClassProperties($argument, $filter = null)
    {
        if (null === $filter) {
            $filter = \ReflectionProperty::IS_STATIC | \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE;
        }

        $reflectionClass = new \ReflectionClass($argument);

        if ($parentClass = $reflectionClass->getParentClass()) {
            return array_merge($this->getClassProperties($parentClass->getName(), $filter), $reflectionClass->getProperties($filter));
        }

        return $reflectionClass->getProperties($filter);
    }