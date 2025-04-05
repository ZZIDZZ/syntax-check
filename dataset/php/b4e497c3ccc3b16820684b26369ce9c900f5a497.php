public function proxy( Container $container, $key ) {
		if ( isset( $this->proxies[ $key ] ) ) {
			return $this->proxies[ $key ];
		}

		$this->proxies[ $key ] = new Proxy( $container, $key );

		return $this->proxies[ $key ];
	}