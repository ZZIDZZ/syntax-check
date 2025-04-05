public function apply(callable $handler)
    {
        $result = $handler;
        foreach ($this->middlewares as $middleware) {
            $result = $middleware($result);
        }

        return $result;
    }