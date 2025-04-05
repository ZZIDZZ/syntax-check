public function fillByData(array $data, Entity $entity = null)
	{
		$entity = $entity ? $entity : $this->createEntity();
		$entity->setLoadedData($data);
		foreach ($data as $key => $value) {
			if ($key == $this->getIdColumnName()) {
				$entity->setLoadedFromDb(true);
			}
			$this->setFieldValueByDbKey($entity, $key, $value);
		}

		return $entity;
	}