public function getDatabaseName()
	{
		$dsn = $this->result->connection->getDsn();
		$matches = [];
		if (preg_match('~\b(database|dbname)=(.*?)(;|$)~', $dsn, $matches))
		{
			return $matches[2];
		}
		return NULL;
	}