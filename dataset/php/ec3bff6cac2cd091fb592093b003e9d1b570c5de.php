public function toUrl($url)
    {
        $allow_not_routed_url = $this->config['allow_not_routed_url'] ?? false;
        $exclude_urls         = $this->config['options']['exclude_urls'] ?? [];
        $exclude_hosts        = $this->config['options']['exclude_hosts'] ?? [];

        $uriTargetHost  = (new Uri($url))->getHost();
        if (true === $allow_not_routed_url ||
            \in_array($url, $exclude_urls) ||
            \in_array($uriTargetHost, $exclude_hosts)
        ) {
            return parent::toUrl($url);
        }

        $controller = $this->getController();

        $request = $controller->getRequest();
        $basePath = $request->getBasePath();

        $default_url = $this->config['default_url'] ?? '/';

        if ($basePath !== '') {
            if (\strpos($url, $basePath) !== 0) {
                $url = $basePath . $url;
            }

            if (\strpos($default_url, $basePath) !== 0) {
                $default_url  = $basePath . $default_url;
            }
        }

        $current_uri = $request->getRequestUri();
        $request->setUri($url);

        $uriTarget = (new Uri($url))->__toString();

        if ($current_uri === $uriTarget) {
            $this->getEventManager()->trigger('redirect-same-url');

            return;
        }

        $mvcEvent = $this->getEvent();
        $routeMatch = $mvcEvent->getRouteMatch();
        $currentRouteMatchName = $routeMatch->getMatchedRouteName();
        $router = $mvcEvent->getRouter();

        $uriCurrentHost = (new Uri($router->getRequestUri()))->getHost();
        if (($routeToBeMatched = $router->match($request))
            && (
                $uriTargetHost === null
                ||
                $uriCurrentHost === $uriTargetHost
            )

            && (
                (
                    ($routeToBeMatchedRouteName = $routeToBeMatched->getMatchedRouteName()) !== $currentRouteMatchName
                        && (
                            $this->manager->has($routeToBeMatched->getParam('controller'))
                            ||
                            $routeToBeMatched->getParam('middleware') !== false
                        )
                )
                ||
                (
                    $routeToBeMatched->getParam('action') != $routeMatch->getParam('action')
                )
                ||
                (
                    $routeToBeMatchedRouteName === $currentRouteMatchName
                )
            )

        ) {
            return parent::toUrl($url);
        }

        return parent::toUrl($default_url);
    }