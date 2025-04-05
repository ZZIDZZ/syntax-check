protected function get_nonces() {
		$nonces = array();

		foreach ( (array) $this->registered_handles as $handle ) {
			$nonces[ $handle ] = wp_create_nonce( $handle );
		}

		return $nonces;
	}