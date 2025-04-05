public function fetchTemplate() {
		if ($this->template != '' && 
			$this->template_data == '' &&
			!$this->checkTemplateExists($this->template)) {
				
			throw new \Exception(sprintf('Template file %s not found',$this->template));
		}
		
		if ($this->template != '') {
			return $this->fetchFromFile();
		} else {
			return $this->fetchFromString();
		}
	}