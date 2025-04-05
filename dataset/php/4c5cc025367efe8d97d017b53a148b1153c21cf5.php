private function get_post_request( $key, $default, $type ) {
		$return = $default;
		if ( false !== $this->has( $key, $type ) ) {
			switch ( $type ) {
				case 'GET':
				case 'get':
					$return = $_GET[ $key ];
					break;

				case 'POST':
				case 'post':
					$return = $_POST[ $key ];
					break;

				case 'REQUEST':
				case 'request':
					$return = $_REQUEST[ $key ];
					break;
				default:
					$return = $default;
					break;
			}
		}
		return $return;
	}