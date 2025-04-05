public function getPrimaryKeys($table)
    {
        $this->checkTableArgument($table);
        $pks = $this->model_definition['tables'][$table]['primary_keys'];
        if (count($pks) == 0) {
            throw new Exception\NoPrimaryKeyException(__METHOD__ . ". No primary keys found on table '$table'.");
        }
        return $pks;
    }