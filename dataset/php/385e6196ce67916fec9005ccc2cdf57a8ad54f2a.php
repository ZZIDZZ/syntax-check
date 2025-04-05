public function send( $message, array $options = [] ) {
		$options[Options::TOKEN]   = $this->token;
		$options[Options::USER]    = $this->user;
		$options[Options::MESSAGE] = $message;

		$opts = [ 'http' => [
			'method'  => 'POST',
			'header'  => 'Content-Type: application/x-www-form-urlencoded',
			'content' => http_build_query($options),
		] ];

		$context = stream_context_create($opts);

		if( $result = @file_get_contents($this->apiUrl, false, $context) ) {
			if( $final = @json_decode($result, true) ) {
				return $final;
			}
		}

		return false;
	}