public function extractParameters(string $path): array
    {
        if ($this->routeParameters === []) {
            return [];
        }
        $parameters = [];
        $pathArray = explode('/', $path);
        array_shift($pathArray);
        foreach ($this->routeParameters as $index => $parameter) {
            $parameterAction = $this->routeParametersOptions[$parameter] ??
                function (string $parameter): string {
                    return $parameter;
                };
            $parameters[$parameter] = $parameterAction($pathArray[$index]);
        }
        return $parameters;
    }