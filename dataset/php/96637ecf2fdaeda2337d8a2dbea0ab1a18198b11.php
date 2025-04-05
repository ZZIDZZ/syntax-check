static function mysql_version()
	{
		$version = DB::select('SELECT VERSION() AS `version`');
		$version = explode('-', $version[0]->version);
		$version = $version[0];
		return $version;
	}