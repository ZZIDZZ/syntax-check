public static function buildDefinitionProvider(Discovery $discovery)
    {
        $bindings = $discovery->findBindings('definition-interop/yaml-definition-files');

        $definitionProviders = [];

        foreach ($bindings as $binding) {
            foreach ($binding->getResources() as $resource) {
                /* @var $resource FileResource */
                $definitionProviders[] = new YamlDefinitionLoader($resource->getFilesystemPath());
            }
        }

        return self::mergeDefinitionProviders($definitionProviders);
    }