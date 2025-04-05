protected function _compareFieldPresence($fixtureFields, $liveFields, $fixtureClass, $fixtureTable) {
		$message = '%s has fields that are not in the live DB:';
		$this->_doCompareFieldPresence($fixtureFields, $liveFields, $fixtureClass, $message, $fixtureTable);

		$message = 'Live DB has fields that are not in %s';
		$this->_doCompareFieldPresence($liveFields, $fixtureFields, $fixtureClass, $message, $fixtureTable);
	}