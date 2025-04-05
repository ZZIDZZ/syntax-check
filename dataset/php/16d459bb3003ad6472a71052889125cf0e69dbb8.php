public function after_request( \Requests_Response &$return )
	{
		$headers   = $return->headers;
		$url       = $return->url;
		$data      = $return->body;
		$signature = $headers['x-signature'];

		if( $this->debug )
		{
			echo "\n\nResponse Data:\n";
			var_dump($return);
		}

		// Check if signature header exists, if not the request failed
		if( !isset($headers['x-signature']) or $headers['x-signature'] == '' )
		{
			throw new \Exception('Request Failed');
		}

		// build up the data to be signed
		$request_data = $this->service_name."\n".$headers['date']."\n".$url."\n";
		if( !empty($data) )
		{
			$request_data .= trim($data);
		}

		// try and validate the signature

		// ------------------------------------
		$generator = EccFactory::getNistCurves()->generator256();

		$order_len  = strlen($this->math_adapter->decHex($generator->getOrder()));
		$x          = $this->math_adapter->hexDec(substr($this->public_key, 0, $order_len));
		$y          = $this->math_adapter->hexDec(substr($this->public_key, $order_len));
		$point      = new Point($this->math_adapter, EccFactory::getNistCurves()->curve256(), $x, $y, $generator->getOrder());
		$public_key = new PublicKey($this->math_adapter, $generator, $point);

		$r         = $this->math_adapter->hexDec(substr($signature, 0, $order_len));
		$s         = $this->math_adapter->hexDec(substr($signature, $order_len));
		$signature = new Signature($r, $s);

		$signer     = EccFactory::getSigner();
		$check_hash = $this->math_adapter->hexDec(hash("sha256", $request_data));
		$result     = $signer->verify($public_key, $signature, $check_hash);
		// ------------------------------------

		//$result = \ECDSA::validate($request_data, $signature, $this->public_key);

		// if signature validation failed, throw exception
		if( $result !== TRUE )
		{
			throw new \Exception('Signature Does Not Validate!');
		}
	}