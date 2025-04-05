public function getLink() {
		if ($this->url === null) {
			return null;
		}
		$link = $this->getLinkWithoutParams();
		
		$params = array();
		// First, get the list of all parameters to be propagated
		if (is_array($this->propagatedUrlParameters)) {
			foreach ($this->propagatedUrlParameters as $parameter) {
				if (isset($_REQUEST[$parameter])) {
					$params[$parameter] = \get($parameter);
				}
			}
		}
		
		if (!empty($params)) {
			if (strpos($link, "?") === FALSE) {
				$link .= "?";
			} else {
				$link .= "&";
			}
			$paramsAsStrArray = array();
			foreach ($params as $key=>$value) {
				$paramsAsStrArray[] = urlencode($key).'='.urlencode($value);
			}
			$link .= implode("&", $paramsAsStrArray);
		}
		
		return $link;
	}