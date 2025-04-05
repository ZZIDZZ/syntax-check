public function loadClassMetadata(string $className)
    {
        $metadata = new ClassMetadata();
        $reflection = new \ReflectionClass($className);

        $this->processClassAnnotations($reflection, $metadata);
        $this->processPropertyAnnotations($reflection, $metadata);

        return $metadata;
    }