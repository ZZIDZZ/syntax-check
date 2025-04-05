public function extractDefault(ColumnSchema $field, $defaultValue)
    {
        if ($defaultValue === 'true') {
            $field->defaultValue = true;
        } elseif ($defaultValue === 'false') {
            $field->defaultValue = false;
        } elseif (0 === stripos($defaultValue, '"identity"')) {
            $field->autoIncrement = true;
        } elseif (preg_match('/^\'(.*)\'::/', $defaultValue, $matches)) {
            parent::extractDefault($field, str_replace("''", "'", $matches[1]));
        } elseif (preg_match('/^(-?\d+(\.\d*)?)(::.*)?$/', $defaultValue, $matches)) {
            parent::extractDefault($field, $matches[1]);
        } else {
            // could be a internal function call like setting uuids
            $field->defaultValue = $defaultValue;
        }
    }