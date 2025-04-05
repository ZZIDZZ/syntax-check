public function has($key)
    {
        return (isset($this->bag[$key]) || array_key_exists($key, $this->bag));
    }