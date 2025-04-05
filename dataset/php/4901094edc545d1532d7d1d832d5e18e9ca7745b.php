public function execute(...$constructParameters)
    {
        $class      = $this->class;
        $method     = $this->method;
        $parameters = array_values($this->parameters);

        $instance = new $class(...$constructParameters);
        return $instance->$method(...$parameters);
    }