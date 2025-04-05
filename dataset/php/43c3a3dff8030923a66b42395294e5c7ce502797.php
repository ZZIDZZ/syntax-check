public function getModelRelations(string $model)
    {
        $class = new ReflectionClass($model);

        $traitMethods = Collection::make($class->getTraits())->map(function (ReflectionClass $trait) {
            return Collection::make($trait->getMethods(ReflectionMethod::IS_PUBLIC));
        })->flatten();

        $methods = Collection::make($class->getMethods(ReflectionMethod::IS_PUBLIC))
            ->merge($traitMethods)
            ->reject(function (ReflectionMethod $method) use ($model) {
                return $method->class !== $model || $method->getNumberOfParameters() > 0;
            });

        $relations = Collection::make();

        $methods->map(function (ReflectionMethod $method) use ($model, &$relations) {
            $relations = $relations->merge($this->getRelationshipFromMethodAndModel($method, $model));
        });

        $relations = $relations->filter();

        if ($ignoreRelations = array_get(config('erd-generator.ignore', []),$model))
        {
            $relations = $relations->diffKeys(array_flip($ignoreRelations));
        }

        return $relations;
    }