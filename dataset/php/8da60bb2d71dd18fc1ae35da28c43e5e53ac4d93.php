public function setDefinition($id, Definition $definition)
    {
        $id = strtolower($id);

        $this->serviceDefinitions[$id] = $definition;

        return $this;
    }