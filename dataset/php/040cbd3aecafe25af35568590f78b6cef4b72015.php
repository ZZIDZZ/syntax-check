public function post($params = array(), $headers = array())
	{
		if (empty($params)) {
			return null;
		}

		$this->httpAction->setApiParams($params);

		$this->httpAction->setApiHeaders(array_merge(array($this->getApiBaseHeader()), $headers));

		return (array) $this->preparePropertiesFromResponse(
			$this->httpAction->post(
				$this->getApiUrl()
			)
		);
	}