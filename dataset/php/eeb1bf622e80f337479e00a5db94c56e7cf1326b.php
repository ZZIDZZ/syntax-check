protected function parseUrl($markdown)
	{
		$pattern = <<<REGEXP
			/(?(R) # in case of recursion match parentheses
				 \(((?>[^\s()]+)|(?R))*\)
			|      # else match a link with title
				^(https?|ftp):\/\/(([^\s<>()]+)|(?R))+(?<![\.,:;\'"!\?\s])
			)/x
REGEXP;

		if (!in_array('parseLink', $this->context) && preg_match($pattern, $markdown, $matches)) {
			return [
				['autoUrl', $matches[0]],
				strlen($matches[0])
			];
		}
		return [['text', substr($markdown, 0, 4)], 4];
	}