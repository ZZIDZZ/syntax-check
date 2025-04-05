public function resolve($file)
    {
        $class = Str::studly(implode('_', array_slice(explode('_', $file), 4)));
        if (!class_exists($class)) {
            $className = str_replace('.', '\\', $this->getRepository()->getGroup());
            $class = $className.'\\Database\\Migrations\\'.$class;
        }

        return new $class;
    }