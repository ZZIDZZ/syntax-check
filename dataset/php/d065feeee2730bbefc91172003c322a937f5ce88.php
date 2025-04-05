public function package($name)
	{
		if( ! isset($this->packages[ $name ]))
		{
			throw new PackageNotDefinedException("$name is not defined");
		}
		return $this->packages[ $name ];
	}