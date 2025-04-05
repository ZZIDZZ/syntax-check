public static function create(
        $containerConfig = null,
        ?RouterInterface $router = null,
        ?DispatcherInterface $dispatcher = null,
        ?ResponseInterface $defaultResponse = null
    ): App {
        $container = self::buildContainer($containerConfig);
        $dispatcher = $dispatcher ?: new Dispatcher();
        $defaultResponse = $defaultResponse ?: new Response();
        $router = $router ?: new Router(
            [],
            ($container->has('router.options') ? $container->get('router.options') : [])
        );

        if ($container->has('router.routes') && is_array($container->get('router.routes'))) {
            $router->addRoutes($container->get('router.routes'));
        }

        $container->set(Dispatcher::class, $dispatcher);
        $container->set(Router::class, $router);
        $container->set(Response::class, $defaultResponse);

        $app = new App($container, $router, $dispatcher, $defaultResponse);

        if ($container->has('app.env') && is_string($container->get('app.env'))) {
            $app->setEnv($container->get('app.env'));
        }

        if ($container->has('app.error.handler') && true === (bool) $container->get('app.error.handler')) {
            $app->enableErrorHandler();
        }

        return $app;
    }