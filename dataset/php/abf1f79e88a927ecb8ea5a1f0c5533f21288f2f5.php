private static function setPrefix(array $config)
	{
		if(array_key_exists('prefix', $config))
		{
			static::$prefix = $config['prefix'];
		}

		// Route group prefix must be set or defined.
		if(is_null(static::$prefix))
		{
			throw new Exception(__CLASS__ . ': $prefix can not be null.');
		}
	}