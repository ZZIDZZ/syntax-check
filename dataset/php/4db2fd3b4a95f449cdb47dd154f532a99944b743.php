public static function dispatch(ICallable $object)
    {
        $params = $object->getParams();
        $call = $object->getCallable();

        if (!is_callable($call)) {
            throw new CallException("Non callable object found");
        }

        if ($call instanceof Closure) {
            return call_user_func_array($call, $params);
        }

        $class = explode('::', $call);

        $reflection = new ReflectionClass($class[0]);
        $method = $reflection->getMethod($class[1]);

        if ($method->isStatic()) {
            return call_user_func_array($call, $params);
        }

        return call_user_func_array(array(new $class[0], $class[1]), $params);
    }