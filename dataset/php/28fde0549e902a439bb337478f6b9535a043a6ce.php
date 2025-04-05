public function read()
    {
        if (is_null($constructor = $this->reflector->getConstructor())) {
            return [];
        }

        $parameters = [];

        foreach ($constructor->getParameters() as $reflectionParameter) {
            /**
             * @var \ReflectionParameter $parameter
             */

            $parameter = [
                "isClass"         => ! is_null($reflectionParameter->getClass()),
                "hasDefaultValue" => $reflectionParameter->isDefaultValueAvailable(),
            ];

            if ($parameter["isClass"]) {
                $parameter["value"] = $reflectionParameter->getClass()->getName();
            }

            if ($parameter["hasDefaultValue"]) {
                $parameter["defaultValue"] = $reflectionParameter->getDefaultValue();
            }

            $parameters[] = $parameter;
        }

        return $parameters;
    }