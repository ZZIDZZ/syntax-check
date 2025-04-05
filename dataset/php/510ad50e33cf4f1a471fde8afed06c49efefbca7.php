static function getConnection($forceNewConnection = false){
		if(self::$connection == null || $forceNewConnection){
			$connectionImpl = Settings::getSettings('php-platform/persist','connection-class');
			$connectionImplReflectionClass = new \ReflectionClass($connectionImpl);
			$connectionImplInterfaces = $connectionImplReflectionClass->getInterfaceNames();
			$connectionInterfaceName = 'PhpPlatform\Persist\Connection\Connection';
			if(!in_array($connectionInterfaceName, $connectionImplInterfaces)){
				throw new NoConnectionException("connection implementation $connectionImpl does not implement $connectionInterfaceName");
			}
			self::$connection = $connectionImplReflectionClass->newInstance();
		}
		return self::$connection;
	}