public function getLabel($caption = NULL)
	{
		$label = clone $this->label;
		$label->for = $this->getHtmlId();

		if (!$label->getHtml()) {
			$label->setText($this->translate($caption === NULL ? $this->caption : $caption));
		}

		return $label;
	}