public function validate_vars_docblock_array($vars_array, $vars_docblock)
	{
		$vars_array        = array_unique($vars_array);
		$vars_docblock     = array_unique($vars_docblock);
		$sizeof_vars_array = sizeof($vars_array);

		if ($sizeof_vars_array !== sizeof($vars_docblock) || $sizeof_vars_array !== sizeof(array_intersect($vars_array, $vars_docblock)))
		{
			throw new \LogicException("\$vars array does not match the list of '@var' tags for event "
				. "'{$this->current_event}' in file '{$this->current_clean_file}:{$this->current_event_line}'");
		}
	}