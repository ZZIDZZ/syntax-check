public static function getTable($className, $dbConn = NULL)
    {
		if (is_null($dbConn)) {
			$dbConn = self::makeDbConn();
		}

        try {
            $table = self::mapClassToTable($className, $dbConn);
        } catch (TableDoesNotExistException $e) {
            return $e->message();
        }

        return $table;
    }