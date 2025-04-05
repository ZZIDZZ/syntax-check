public function logout( $url = '', $service = '' ) {
		if ( phpCAS::isSessionAuthenticated() ) {
			if ( isset( $_SESSION['phpCAS'] ) ) {
				$serialized = serialize( $_SESSION['phpCAS'] );
				phpCAS::log( 'Logout requested, but no session data found for user:'
				             . PHP_EOL . $serialized );
			}
		}
		$params = [];
		if ( $service ) {
			$params['service'] = $service;
		} elseif ( $this->config['cas_logout_redirect'] ) {
			$params['service'] = $this->config['cas_logout_redirect'];
		}
		if ( $url ) {
			$params['url'] = $url;
		}
		phpCAS::logout( $params );
		exit;
	}