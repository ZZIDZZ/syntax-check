private function calculateArguments(array $config): array
    {
        $args = [];

        foreach ($config as $key => $item)
        {
            if (\is_string($item) && $this->base->has($item)) {
                $args[] = $this->base->get($item);
                continue;
            }

            if (\is_string($key) && \is_array($item)) {
                $this->dc->set($key, $item);
                $args[] = $this->dc->get($key);
                continue;    
            }

            $args[] = $item;
        }

        return $args;
    }