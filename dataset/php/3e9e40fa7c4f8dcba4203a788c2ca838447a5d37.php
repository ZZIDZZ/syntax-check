public function close():Log{

		if(!empty($this->logOutputInterfaces)){
			foreach($this->logOutputInterfaces as $instanceName => $instance){
				unset($this->logOutputInterfaces[$instanceName]);
			}
		}

		return $this;
	}