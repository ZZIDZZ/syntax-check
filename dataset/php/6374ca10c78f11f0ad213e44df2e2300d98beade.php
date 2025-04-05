public function resolveArguments(ReflectionClass $classReflection, array $arguments)
    {
        $resolvedArguments = [];

        foreach ($arguments as $key => $argument) {
            $resolvedArguments[$key] = $this->resolveArgument($argument);
        }

        return $resolvedArguments;
    }