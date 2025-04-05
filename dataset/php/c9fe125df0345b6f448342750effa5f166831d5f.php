public function isValid($value, Constraint $constraint)
	{
		if (empty($value)) {
			return true;
		}
		
		$ret = $this->validateNumber($value, $constraint->format);
		
		if (!$ret) {
			$this->setMessage($constraint->message);
		}
		
		return $ret;
	}