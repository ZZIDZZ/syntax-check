public function getEntityTypeId($entityTypeCode = null)
    {

        // load the entity type for the given code, or the default one otherwise
        $entityType = $this->getEntityType($entityTypeCode ? $entityTypeCode : $this->getDefaultEntityTypeCode());

        // return the entity type ID
        return $entityType[MemberNames::ENTITY_TYPE_ID];
    }