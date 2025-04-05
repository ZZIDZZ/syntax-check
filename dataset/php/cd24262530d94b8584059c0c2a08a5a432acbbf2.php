public function getResolvers($subject)
    {
        $key = \is_object($subject) ? \get_class($subject) : \gettype($subject);
        
        if (\array_key_exists($key, $this->cache)) {
            return $this->cache[$key];
        }
        
        $this->cache[$key] = [];
        
        foreach ($this->resolvers as $resolver) {
            if ($resolver->canResolve($subject)) {
                $this->cache[$key][] = $resolver;
            }
        }
        
        return $this->cache[$key];
    }