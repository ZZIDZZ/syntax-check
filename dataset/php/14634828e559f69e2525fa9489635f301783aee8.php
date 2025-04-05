public function upgrade( $current, $args = [] ) {
		set_error_handler( [ __CLASS__, 'error_handler' ], E_USER_WARNING | E_USER_NOTICE );

		$result = parent::upgrade( $current, $args );

		restore_error_handler();

		return $result;
	}