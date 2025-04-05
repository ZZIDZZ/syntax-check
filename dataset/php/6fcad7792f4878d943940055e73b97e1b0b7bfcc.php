protected function public__insertMultiple($table_name, array $data_to_insert)
    {
        $pdo = $this->getPDOInstance();
        $fieldNames = \implode('`, `', \array_values($data_to_insert['field_names']));
        $sqlQuery = "INSERT INTO " . $this->quoteTableName($this->getPrefixedTableName($table_name)) . " (`$fieldNames`) VALUES ";

        $i = 0;
        $fieldValues = '';
        foreach ($data_to_insert['values'] as $rec_value)
        {
            $fieldValues .= '(';
            foreach ($rec_value as $value)
            {
                $fieldValues .= ":v$i,";
                $i++;
            }
            $fieldValues .= \rtrim($fieldValues, ',') . '),';
        }
        $sqlQuery .= \rtrim($fieldValues, ',') . ";";
        $sth = $pdo->prepare($sqlQuery);

        $i = 0;
        foreach ($data_to_insert['values'] as $rec_value)
        {
            foreach ($rec_value as $value)
            {
                $sth->bindValue(':v' . $i++, $value, $this->getPdoType(\gettype($value)));
            }
        }

        try
        {
            $pdo->beginTransaction();
            $sth->execute();
            $pdo->commit();
        }
        catch (Exception $exc)
        {
            $pdo->rollback();
            return FALSE;
        }

        return TRUE;
    }