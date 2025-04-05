public function flashMessage($message, $type = 'info')
	{
		return parent::flashMessage($this->translator->translate($message), $type);
	}