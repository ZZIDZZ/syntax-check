private function hasContentType($contentType)
	{
		foreach ($this->getHeader('Content-Type') as $key => $value) {
			if (substr($value, 0, strlen($contentType)) == $contentType) {
				return true;
			}
		}

		return false;
	}