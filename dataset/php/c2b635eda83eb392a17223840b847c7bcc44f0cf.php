public function canCreate(ContainerInterface $container, $requestedName)
    {
        $fqcn = $this->getFQCN($requestedName);
        if ($fqcn === false) {
            return false;
        }

        return \class_exists($fqcn);
    }