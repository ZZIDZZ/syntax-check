public function findFile($class)
    {
        if (xcache_isset($this->prefix.$class)) {
            $file = xcache_get($this->prefix.$class);
        } else {
            $file = $this->decorated->findFile($class) ?: null;
            xcache_set($this->prefix.$class, $file);
        }

        return $file;
    }