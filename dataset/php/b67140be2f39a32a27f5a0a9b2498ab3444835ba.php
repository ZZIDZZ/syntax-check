protected function resolveOneOrFail($middleware, &$key = null)
    {
        $type = is_object($middleware) ? get_class($middleware) : gettype($middleware);
        $middleware = $this->resolveOne($middleware, $key);

        if ($middleware === false) {
            $className = MiddlewareInterface::class;
            $method = get_class($this) . "::resolve";
            $msg = "%s expected a Closure, a callable or abstract %s string, or %s. Received: %s";

            throw new InvalidArgumentException(sprintf($msg, $method, $className, $className, $type));
        }
        return $middleware;
    }