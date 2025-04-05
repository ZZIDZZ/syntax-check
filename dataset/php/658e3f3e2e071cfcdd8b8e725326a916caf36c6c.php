public function get($key)
    {
        return $this->container->hasParameter($key) ? $this->container->getParameter($key) : null;
    }