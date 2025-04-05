private function cacheIfConfigured($closure)
    {
        if (config('menu.cache.enable')) {
            $key = config('menu.cache.key');
            $minutes = config('menu.cache.minutes');

            return Cache::remember($key, $minutes, function () use ($closure) {
                return call_user_func($closure);
            });
        }

        return call_user_func($closure);
    }