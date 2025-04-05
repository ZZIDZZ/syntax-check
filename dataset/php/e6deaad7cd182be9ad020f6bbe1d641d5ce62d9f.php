protected function newAttributesQuery(array $attributes, $operator = '=')
	{
		$query = $this->newQuery();

		foreach ($attributes as $key => $value) {
			$query->where($key, $operator, $value);
		}

		return $query;
	}