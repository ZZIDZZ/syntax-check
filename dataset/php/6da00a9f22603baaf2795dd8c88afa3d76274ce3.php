public static function fromFile(string $file, string $prefix = ''): SqliteConnection
    {
        $pdo = new \PDO('sqlite:' . $file);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        $pdo->exec("PRAGMA foreign_keys = ON");
        
        return new static($pdo, $prefix);
    }