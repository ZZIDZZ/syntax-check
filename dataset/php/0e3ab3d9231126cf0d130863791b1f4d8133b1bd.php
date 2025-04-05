public function getWebdriver()
	{
		$browser = $this->browser;
		$config = parse_ini_file(__DIR__ . '/config.dist.ini', true);

		if (file_exists(__DIR__ . '/config.ini'))
		{
			$config = parse_ini_file(__DIR__ . '/config.ini', true);
		}

		if ($browser == 'chrome')
		{
			$driver['type'] = 'webdriver.chrome.driver';
		}
		elseif ($browser == 'firefox')
		{
			$driver['type'] = 'webdriver.gecko.driver';
		}
		elseif ($browser == 'MicrosoftEdge')
		{
			$driver['type'] = 'webdriver.edge.driver';
		}
		elseif ($browser == 'edg')
		{
			$driver['type'] = 'webdriver.edg.driver';
		}
		elseif ($browser == 'internet explorer')
		{
			$driver['type'] = 'webdriver.ie.driver';
		}

		// All the exceptions in the world...
		if (isset($config[$browser][$this->getOs()]))
		{
			$driver['path'] = __DIR__ . '/' . $config[$browser][$this->getOs()];
		}
		else
		{
			print('No driver for your browser. Check your browser configuration in config.ini');

			// We can't do anything without a driver, exit
			exit(1);
		}

		return '-D' . implode('=', $driver);
	}