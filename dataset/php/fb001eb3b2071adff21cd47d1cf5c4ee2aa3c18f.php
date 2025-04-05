protected function _strpos( $haystack, $needle ) {
		return function_exists( 'mb_strpos' ) ? mb_strpos( $haystack, $needle ) : strpos( $haystack, $needle );
	}