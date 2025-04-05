public function register(Application $app)
    {
        $app['doctrine_orm.configuration'] = $app->share(function ($app) {
            $configuration = new Configuration();

            $mCache = isset($app['doctrine_orm.metadata_cache']) ? $app['doctrine_orm.metadata_cache'] : new Cache();
            $qCache = isset($app['doctrine_orm.query_cache']) ? $app['doctrine_orm.query_cache'] : new Cache();
            $rCache = isset($app['doctrine_orm.result_cache']) ? $app['doctrine_orm.result_cache'] : new Cache();

            $annotation = boolval($app['doctrine_orm.simple_annotation_reader']);
            $driverImpl = $configuration->newDefaultAnnotationDriver($app['doctrine_orm.entities_path'], $annotation);

            $configuration->setMetadataCacheImpl($mCache);
            $configuration->setMetadataDriverImpl($driverImpl);
            $configuration->setQueryCacheImpl($qCache);
            $configuration->setResultCacheImpl($rCache);
            $configuration->setProxyDir($app['doctrine_orm.proxies_path']);
            $configuration->setProxyNamespace($app['doctrine_orm.proxies_namespace']);
            $configuration->setAutogenerateProxyClasses(false);

            if (isset($app['doctrine_orm.autogenerate_proxy_classes'])) {
                $configuration->setAutogenerateProxyClasses($app['doctrine_orm.autogenerate_proxy_classes']);
            } else {
                $configuration->setAutogenerateProxyClasses(true);
            }

            return $configuration;
        });

        $app['doctrine_orm.connection'] = $app->share(function ($app) {
            return DriverManager::getConnection(
                $app['doctrine_orm.connection_parameters'],
                $app['doctrine_orm.configuration'],
                new EventManager()
            );
        });

        $app['doctrine_orm.em'] = $app->share(function ($app) {
            return EntityManager::create(
                $app['doctrine_orm.connection'],
                $app['doctrine_orm.configuration'],
                $app['doctrine_orm.connection']->getEventManager()
            );
        });
        
    }