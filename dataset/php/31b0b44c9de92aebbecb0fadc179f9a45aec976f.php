public function arrayToCollection(array $source, $collectionClass)
    {
        $manager = $this->manager;
        if ($manager instanceof ArrayCasterManagerInterface) {
            return $manager->process($source, $collectionClass);
        }
        
        throw new \LogicException(
            "The manager must be set to cast array in collection"
        );
    }