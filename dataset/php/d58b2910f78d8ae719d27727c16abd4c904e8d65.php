public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // Configure client services
        $first = isset($config['providers']['default']) ? 'default' : null;
        foreach ($config['providers'] as $name => $arguments) {
            if (null === $first) {
                $first = $name;
            }

            $factoryClass = $container->getDefinition($arguments['factory'])->getClass();
            $factoryClass::validate($arguments['options'], $name);

            // See if any option has a service reference
            $arguments['options'] = $this->findReferences($arguments['options']);

            $def = $container->register('cache.provider.'.$name, DummyAdapter::class);
            $def->setFactory([new Reference($arguments['factory']), 'createAdapter'])
                ->addArgument($arguments['options'])
                ->setPublic(true);

            $def->addTag('cache.provider');
            foreach ($arguments['aliases'] as $alias) {
                $container->setAlias($alias, new Alias('cache.provider.'.$name, true));
            }
        }

        if (null !== $first) {
            $container->setAlias('cache', 'cache.provider.'.$first);
            $container->setAlias('php_cache', 'cache.provider.'.$first);
        }
    }