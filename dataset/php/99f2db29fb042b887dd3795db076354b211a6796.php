private static function parse_str( $str ) {
	    $output = [];
	    if (function_exists('mb_parse_str') && !isset($this->env['slim.tests.ignore_multibyte'])) {
	        mb_parse_str($str, $output);
	    } else {
	        parse_str($str, $output);
	    }
	    return $output;	
	}