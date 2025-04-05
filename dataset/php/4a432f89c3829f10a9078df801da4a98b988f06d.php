public function getOption($value)
	{
		if(!in_array(strtolower($value), $this->allowedOptions, true))
		{
			throw new InvalidOptionValueException('Invalid $value argument "' . $value . '", allowed values: '
			                                      . implode(', ', $this->allowedOptions));
		}
		
		return '-compose ' . strtolower($value) . ' ';
	}