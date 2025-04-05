protected function _attributeType(array &$attributes)
	{
		// Reset field lengths for data types that don't support it
		if (isset($attributes['CONSTRAINT']) && stripos($attributes['TYPE'], 'int') !== false)
		{
			$attributes['CONSTRAINT'] = null;
		}

		switch (strtoupper($attributes['TYPE']))
		{
			case 'TINYINT':
				$attributes['TYPE']     = 'SMALLINT';
				$attributes['UNSIGNED'] = false;
				break;
			case 'MEDIUMINT':
				$attributes['TYPE']     = 'INTEGER';
				$attributes['UNSIGNED'] = false;
				break;
			case 'DATETIME':
				$attributes['TYPE'] = 'TIMESTAMP';
				break;
			default:
				break;
		}
	}