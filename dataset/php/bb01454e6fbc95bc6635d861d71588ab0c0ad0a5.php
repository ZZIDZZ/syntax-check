public function getPathAttribute()
	{
		$ancestors = $this->getAncestors();
		$return = array();
		foreach($ancestors as $ancestor) {
			$return[] = $ancestor->name;
		}
		$return[] = $this->name;
		return implode(' > ', $return);
	}