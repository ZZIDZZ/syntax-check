public function extractDefault(ColumnSchema $field, $defaultValue)
    {
        $phpType = DbSimpleTypes::toPhpType($field->type);
        $field->defaultValue = $this->formatValueToPhpType($defaultValue, $phpType);
    }