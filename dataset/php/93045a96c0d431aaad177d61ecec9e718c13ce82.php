public function none($content = null, $emphasis = null, $dismissible = false, array $attributes = array())
	{
		return $this->alert('message', $content, $emphasis, $dismissible, $attributes);
	}