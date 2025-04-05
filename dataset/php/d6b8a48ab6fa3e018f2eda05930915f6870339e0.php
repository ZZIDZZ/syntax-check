public function cacheQuery($builder, array $columns, Closure $closure)
    {
        $modelName = $this->getMorphClass();
        $lifetime = $this->getCacheLifetime();
        $cacheKey = $this->generateCacheKey($builder, $columns);

        // Switch cache driver on runtime
        if ($driver = $this->getCacheDriver()) {
            app('cache')->setDefaultDriver($driver);
        }

        // We need cache tags, check if default driver supports it
        if (method_exists(app('cache')->getStore(), 'tags')) {
            $result = $lifetime === -1 ? app('cache')->tags($modelName)->rememberForever($cacheKey, $closure) : app('cache')->tags($modelName)->remember($cacheKey, $lifetime, $closure);

            return $result;
        }

        $result = $lifetime === -1 ? app('cache')->rememberForever($cacheKey, $closure) : app('cache')->remember($cacheKey, $lifetime, $closure);

        // Default cache driver doesn't support tags, let's do it manually
        static::storeCacheKey($modelName, $cacheKey);

        // We're done, let's clean up!
        $this->resetCacheConfig();

        return $result;
    }