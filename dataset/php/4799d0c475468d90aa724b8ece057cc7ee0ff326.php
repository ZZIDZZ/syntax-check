private function object($value): string
    {
        $class = $this->classname($value);

        if ($class == \Closure::class) {
            return 'function {closure}()';
        }

        return ($this->callable && is_callable($value))
            ? sprintf('function %s::__invoke()', $class)
            : sprintf('Object(%s)', $class);
    }