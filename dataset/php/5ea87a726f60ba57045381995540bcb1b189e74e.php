public function get_version($asArray=false) {
//		trigger_error("Deprecated function called (". __METHOD__ .")", E_USER_NOTICE);
//		return self::parse_version_file($this->versionFileLocation, $asArray);
		
		if($asArray) {
			$retval = $this->_versionData;
			$retval['version_string'] = self::build_full_version_string($this->_versionData);
		}
		else {
//			$retval = self::build_full_version_string($this->_versionData);
			$retval = $this->_fullVersionString;
		}
		
		return $retval;
	}