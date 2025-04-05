public function addRoute(RouteInterface $route) {
        if (!$route->isValid()) {
            //perhaps some log?
            return;
        }

        $routeValue = $route->getAction()->getValue();
        $this->app->map(
            [strtolower($route->getMethod()->getValue())],
            $route->getUri()->getValue(),
            function (
                RequestInterface $request,
                ResponseInterface $response,
                $params
            ) use ($routeValue) {
                $handler = $this->get($routeValue);
                return $handler->execute($request, $response, $params);
            }
        );
    }