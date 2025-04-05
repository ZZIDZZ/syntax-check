private function fnc_call_plugin_funcs( $func_list ){
		if( is_null($func_list) ){ return false; }
		$param_arr = func_get_args();
		array_shift($param_arr);

		if( @!empty( $func_list ) ){
			// functions
			if( is_object($func_list) ){
				$func_list = get_object_vars( $func_list );
			}
			if( is_string($func_list) ){
				$fnc_name = $func_list;
				$fnc_name = preg_replace( '/^\\\\*/', '\\', $fnc_name );
				$option_value = null;
				preg_match( '/^(.*?)(?:\\((.*)\\))?$/s', $fnc_name, $matched );
				if(array_key_exists( 1, $matched )){
					$fnc_name = @$matched[1];
				}
				if(array_key_exists( 2, $matched )){
					$option_value = @$matched[2];
				}
				unset($matched);
				if( strlen( trim($option_value) ) ){
					$option_value = json_decode( $option_value );
				}else{
					$option_value = null;
				}
				// var_dump($fnc_name);
				// var_dump($option_value);
				$this->proc_num ++;
				if( @!strlen($this->proc_id) ){
					$this->proc_id = $this->proc_type.'_'.$this->proc_num;
				}
				array_push( $param_arr, $option_value );
				call_user_func_array( $fnc_name, $param_arr);
				$this->proc_id = null;

			}elseif( is_array($func_list) ){
				foreach( $func_list as $fnc_id=>$fnc_name ){
					if( is_string($fnc_name) ){
						$fnc_name = preg_replace( '/^\\\\*/', '\\', $fnc_name );
					}
					if( is_string($fnc_id) && !preg_match('/^[0-9]+$/', $fnc_id) ){
						$this->proc_id = $fnc_id;
					}
					$param_arr_dd = $param_arr;
					array_unshift( $param_arr_dd, $fnc_name );
					call_user_func_array( array( $this, 'fnc_call_plugin_funcs' ), $param_arr_dd);
				}
			}
			unset($fnc_name);
		}
		return true;
	}