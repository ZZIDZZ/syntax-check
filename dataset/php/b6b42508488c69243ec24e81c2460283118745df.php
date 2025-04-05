public function perform(): Client {
		if (!empty($this->getUrl())){
			$this->setOption(CURLOPT_URL, $this->getUrl());
		}

		if ($this->getOptions()[CURLOPT_HEADER] === 1) {
			$this->setResponse(substr($this->getResponse(), $this->getInfo(CURLINFO_HEADER_SIZE)));
		}

		$this->setResponse(curl_exec($this->getCurl()));

		/**
		 * Check returned HTTP code between 100 and 399.
		 * See issue #1
		 */
		if (filter_var(
			$this->getInfo(CURLINFO_HTTP_CODE),
			FILTER_VALIDATE_INT,
			['options' => ['min_range' => 100, 'max_range' => 399]])
		) {
			$this->_call($this->successCallback ?? function(Client $instance){}, $this);
		}
		else {
			$this->_call($this->errorCallback ?? function(Client $instance){}, $this);
		}

		return $this;
	}