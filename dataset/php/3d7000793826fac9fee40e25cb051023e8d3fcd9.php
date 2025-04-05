public static function path($path)
	{
		$loaders = spl_autoload_functions();
		$loader = require $path;

		// Check whether autoloader is registered at all
		if ($loaders and in_array(array($loader, 'loadClass'), $loaders))
		{
			// Create new loader first using the previous one
			$newLoader = new Loader($loader);

			$loader->unregister();

			return spl_autoload_register(array($newLoader, 'loadClass'));
		}

		return false;
	}