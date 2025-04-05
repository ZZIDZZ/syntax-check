public static function addTemplateRoot(
		array &$globalConfig,
		string $directory,
		string $trim,
		string $referenceName = ''
	) {
		if (!isset($globalConfig['view'])) {
			$globalConfig['view'] = [];
		}
		if (!isset($globalConfig['view'][self::CONFIG_TEMPLATE_ROOTS])) {
			$globalConfig['view'][self::CONFIG_TEMPLATE_ROOTS] = [];
		}
		$globalConfig['view'][self::CONFIG_TEMPLATE_ROOTS][] = [
			'directory' => $directory,
			'trim'      => $trim,
			'name'      => $referenceName,
		];
	}