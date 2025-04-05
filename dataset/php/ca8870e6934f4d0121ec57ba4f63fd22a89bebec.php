public function getDescriptor()
    {
        return [
            'constraint' => [
                'parent_id' => $this->getTaxonomyName() ? $this->getTaxonomy($this->getManager()->newEntity())->id : null,
            ],
        ];
    }