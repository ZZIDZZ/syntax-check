public function run(Request $request, callable $kernel): Response
    {
        $next = array_reduce(array_reverse($this->middlewareStack), function(callable $next, MiddlewareLayerInterface $layer): \Closure {

            return function(Request $request) use ($next, $layer): Response {
                return $layer->handle($request, $next);
            };

        }, function(Request $request) use ($kernel): Response {
            return $kernel($request);
        });

        return $next($request);
    }