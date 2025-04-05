private function getWiredParameters(\ReflectionClass $reflection, array $overrides): array
    {
        $constructor = $reflection->getConstructor();

        if (!$constructor instanceof \ReflectionMethod) {
            return [];
        }

        $parameters = [];

        foreach ($constructor->getParameters() as $parameter) {
            $name = '$' . $parameter->getName();

            if (isset($overrides[$name])) {
                $parameters[] = $overrides[$name];
                continue;
            }

            $type = $parameter->getType();

            if (!$type instanceof \ReflectionType || $type->isBuiltin()) {
                throw new \InvalidArgumentException(
                    sprintf("Missing autowired parameter '%s' for '%s'", $name, $reflection->getName())
                );
            }

            $parameters[] = $type->getName();
        }

        return $parameters;
    }