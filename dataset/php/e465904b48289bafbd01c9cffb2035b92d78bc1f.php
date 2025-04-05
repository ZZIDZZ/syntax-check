public function get_notice( $id ) {
		$id = self::$instance->get_id( $id );
		if ( ! is_array( self::$instance->notices ) || ! array_key_exists( $id, self::$instance->notices ) ) {
			return false;
		}
		return self::$instance->notices[ $id ];
	}