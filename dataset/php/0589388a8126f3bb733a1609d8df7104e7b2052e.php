public function getModel($table, $connection = null)
    {
        if (!$connection) {
            return $this['idiorm.db']->for_table($table);
        } else {
            return $this['idiorm.dbs'][$connection]->for_table($table);
        }
    }