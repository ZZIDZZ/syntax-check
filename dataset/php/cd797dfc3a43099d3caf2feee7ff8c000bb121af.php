private function getParameters($parameterStrings): array
    {
        $parameters = array();
        foreach ($parameterStrings as $parameterString) {
            $parameters[] = $this->parameterParser->parse($parameterString);
        }

        return $parameters;
    }