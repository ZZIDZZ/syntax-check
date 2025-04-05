public function toArray($entity)
    {
        $entityManager = $this->getEntityManager();
        $unitOfWork    = $entityManager->getUnitOfWork();
        $classMetadata = $this->getClassMetadata();
        $result        = [];

        foreach ($unitOfWork->getOriginalEntityData($entity) as $field => $value) {
            if ($classMetadata->hasAssociation($field)) {
                $associationMapping = $classMetadata->getAssociationMapping($field);

                // Only owning side of x-1 associations can have a FK column.
                if (!$associationMapping['isOwningSide'] || !($associationMapping['type'] & ClassMetadata::TO_ONE)) {
                    continue;
                }

                if ($value !== null) {
                    $newValId    = $unitOfWork->getEntityIdentifier($value);
                    $targetClass = $entityManager->getClassMetadata($associationMapping['targetEntity']);

                    /** @noinspection ForeachSourceInspection */
                    foreach ($associationMapping['joinColumns'] as $joinColumn) {
                        $sourceColumn = $joinColumn['name'];
                        $targetColumn = $joinColumn['referencedColumnName'];

                        if ($value === null) {
                            $result[$sourceColumn] = null;
                        } elseif ($targetClass->containsForeignIdentifier) {
                            $result[$sourceColumn] = $newValId[$targetClass->getFieldForColumn($targetColumn)];
                        } else {
                            $result[$sourceColumn] = $newValId[$targetClass->fieldNames[$targetColumn]];
                        }
                    }
                }
            } elseif ($classMetadata->hasField($field)) {
                $columnName          = $classMetadata->getFieldName($field);
                $result[$columnName] = $value;
            }
        }

        return $result;
    }