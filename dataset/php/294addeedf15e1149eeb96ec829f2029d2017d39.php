public function getContent($keyName = null)
    {
		if (!is_null($keyName)) {
			return (array_key_exists($keyName, $this->lines)) ? $this->lines[$keyName] : null;
		}
        return $this->lines;
    }