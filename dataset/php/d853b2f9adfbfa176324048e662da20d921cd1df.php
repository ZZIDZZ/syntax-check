protected function checkAccess($permission, $arguments = '') {
		if ( $this->acl === false )
			return true;
			
		$driver = "acl" . ucfirst( $this->driver );

		return $this->$driver($permission, $arguments);
	}