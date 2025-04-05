public function add(string $name, string $type = null, array $options = []): CompoundColumnBuilderInterface
    {
        $this->unresolvedColumns[$name] = [
            'type' => $type,
            'options' => $options,
        ];

        return $this;
    }