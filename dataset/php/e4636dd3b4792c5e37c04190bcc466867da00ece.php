protected function updateWhere($where, $value)
    {
        $this->checkDb();
        $properties = $this->getProperties();
        $columns = array_keys($properties);
        $values  = array_values($properties);
        $values1 = is_array($value)
            ? $value
            : [$value];
        $values = array_merge($values, $values1);

        $this->db->connect()
                 ->update($this->tableName, $columns)
                 ->where($where)
                 ->execute($values);
    }