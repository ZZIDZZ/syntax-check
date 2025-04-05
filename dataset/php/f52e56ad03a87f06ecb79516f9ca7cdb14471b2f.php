private function getOauthSignature(array $params, $httpMethod, $url) : string
	{
		$urlParams = [];
		foreach ($params as $key => $value) {
			$params[$key] = rawurlencode($value);
			$urlParams[$key] = $key . '=' . $params[$key];
		}

		ksort($urlParams);
		$parameterString = implode('&', $urlParams);
		$signatureBaseString = strtoupper($httpMethod) .
			'&' . rawurlencode($url) .
			'&' . rawurlencode($parameterString);

		$signingKey = rawurlencode($this->consumerSecret) . '&' . rawurlencode($this->accessTokenSecret);
		$oauthSignature = base64_encode(hash_hmac('sha1', $signatureBaseString, $signingKey, true));

		return $oauthSignature;
	}