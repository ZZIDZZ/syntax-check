private function _processXmlToArray(SimpleXMLElement $xmlArray) {
		$returnArray = array();

		// Process into array
		foreach($xmlArray as $xmlElement) {
			$elementArray = array();

			// Loop through each element
			foreach($xmlElement as $key => $element) {
				// Use strval() to make sure no SimpleXMLElement objects remain
				$elementArray[$key] = strval($element);
			}

			// Store array of elements
			$returnArray[] = $elementArray;
		}

		return $returnArray;
	}