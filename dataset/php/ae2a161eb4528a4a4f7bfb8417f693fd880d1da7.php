public function submitTag($options = array())
    {
    	$jsSubmit = $this->submitCall();
    
    	return function ($options) use($jsSubmit)
    	{
    		$confirm = '';
    		if (isset($options['confirm']) && $options['confirm'] === true) {
    
    			$msg = "Are you sure you want to perform this action?";
    			if(isset($options['confirm_msg'])) {
    				$msg = htmlentities(str_replace("'", '"', $options['confirm_msg']), ENT_QUOTES);
    			}
    			$confirm .= "if(confirm('".$msg."'))" ;
    		}
    		$html = '<button class="' . (isset($options['class']) ? $options['class'] : "") . '"
    		id="' . (isset($options['id']) ? $options['id'] : "") . '"
    		onclick="' .$confirm. call_user_func($jsSubmit, $options) . 'return false;">';
    		$html .= $options['text'];
    		$html .= '</button>';
    
    		return $html;
    	};
    }