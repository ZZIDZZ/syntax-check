public function generateUri(string $name, array $substitutions = [], array $options = []): string
    {
        $this->injectRoutes();

        if (! $this->router->hasNamedRoute($name)) {
            throw new Exception\RuntimeException(sprintf(
                'Cannot generate URI based on route "%s"; route not found',
                $name
            ));
        }

        return $this->router->urlFor($name, $substitutions);
    }