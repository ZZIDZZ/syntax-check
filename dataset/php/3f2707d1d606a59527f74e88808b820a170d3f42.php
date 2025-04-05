public function getRepository($typeName)
    {
        if (isset($this->repositories[$typeName])) {
            return $this->repositories[$typeName];
        }

        if (!isset($this->types[$typeName])) {
            throw new RuntimeException(sprintf('No search finder configured for %s', $typeName));
        }

        $repository = $this->createRepository($typeName);
        $this->repositories[$typeName] = $repository;

        return $repository;
    }