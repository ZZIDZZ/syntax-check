protected function removeFromCache(string $key): bool
    {
        $key = $this->normalizeCacheKey($key);
        $cacheItemPool = $this->sdk->getCacheItemPool();
        if ($cacheItemPool) {
            $cacheKey = $this->sdk->getCachePrefix() . $key;

            if ($cacheItemPool->hasItem($cacheKey)) {
                return $cacheItemPool->deleteItem($cacheKey);
            }
        }

        return true;
    }