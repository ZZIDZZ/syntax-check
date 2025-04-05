public function has($key)
    {
        if (strpos($key, '.') === false) {
            return $this->hasByKey($key);
        }

        return $this->hasByPath($key);
    }