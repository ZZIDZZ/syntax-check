public static function createTable($table, array $specs)
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . static::e($table) . ' (';
        foreach($specs as $field => $opts) {
            $sql .= "\n" .  '`' . $field . '` ' . $opts['type'];
            if($opts['primary'] == true) {
                $opts['nullable'] = false;
                $opts['default'] = null;
                $sql .= ' PRIMARY KEY AUTOINCREMENT';
            }
            if(!$opts['nullable']) {
                $sql .= ' NOT NULL';
            }
            if($opts['default']) {
                $sql .= ' DEFAULT ' . $opts['default'];
            }
            $sql .= ',';
        }

        $sql = trim($sql, ',') . "\n" . ');';
        return $sql;
    }