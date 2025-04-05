private function filterFieldList(array $fields, array $excludedFieldNames, array $excludedFieldTypes, $maxNumFields)
    {
        $filteredFields = [];

        foreach ($fields as $name => $metadata) {
            if (!\in_array($name, $excludedFieldNames) && !\in_array($metadata['type'], $excludedFieldTypes)) {
                $filteredFields[$name] = $fields[$name];
            }
        }

        if (\count($filteredFields) > $maxNumFields) {
            $filteredFields = \array_slice($filteredFields, 0, $maxNumFields, true);
        }

        return $filteredFields;
    }