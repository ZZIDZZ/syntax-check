protected function prepare_value( $value ) {
		if ( is_string( $value ) && ( $value === 'true' || $value === 'on' ) || $value === true ) {
			return true;
		}

		return null;
	}