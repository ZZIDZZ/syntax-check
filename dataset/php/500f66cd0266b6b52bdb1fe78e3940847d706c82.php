protected function flattenArray($data)
	{
		if (is_array($data) || is_object($data)) {
			$buffer = array();

			foreach ($data as $item) {
				$buffer = array_merge($buffer, $this->flattenArray($item));
			}

			return $buffer;
		}
		else {
			return (array) $data;
		}
	}