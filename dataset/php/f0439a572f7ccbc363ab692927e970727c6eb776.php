public function reducing($name)
    {
        // note, once we stop supporting php 5.5, we can rewrite the code below
        // to the reducing($name, ...$args) structure.
        // http://php.net/manual/en/functions.arguments.php#functions.variable-arg-list

        if (is_string($name) &&
            in_array(
                $name,
                [
                    'add',
                    'chain',
                    'join',
                    'max',
                    'min',
                    'mul',
                    'sub',
                ]
            )) {
            return call_user_func_array(sprintf('\Zicht\Itertools\reductions\%s', $name), array_slice(func_get_args(), 1));
        }

        throw new \InvalidArgumentException(sprintf('$NAME "%s" is not a valid reduction.', $name));
    }