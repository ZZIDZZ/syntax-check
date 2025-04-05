public function has($key)
    {
        \WildWolf\Cache\Validator::validateKey($key);

        if (isset($this->cache[$key])) {
            list(, $expires) = $this->cache[$key];

            if (null === $expires || (new \DateTime()) < $expires) {
                return true;
            }

            unset($this->cache[$key]);
        }

        return false;
    }