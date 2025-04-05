protected function addOrEditObject($data = [], $redirect = TRUE)
	{
		$section = $this->getSession('Aprila.lastAddedObject');
		$stateOk = FALSE;

		try {
			if ($this->detailObject) {
				// Edit object
				$this->canUser('edit');
				$this->mainManager->edit($this->detailObject->id, $data);
				$stateOk = TRUE;
				$this->flashMessage('Object saved');

			} else {
				// Add object
				$this->canUser('add');
				$new = $this->mainManager->add($data);
				try {
					$object = $new->toArray();
				} catch (\Exception $e) {
					$object = NULL;
					$this->logger->log($e->getMessage(), ILogger::ERROR);
				}

				$section->newObject = ArrayHash::from($object);
				$stateOk = TRUE;
				$this->flashMessage('Object added');
			}

			// Do something
			$this->afterSaveObject($data);

		} catch (\Exception $e) {
			$this->flashMessage('System problem due saving object', 'error');
			$this->logger->log($e->getMessage(), ILogger::ERROR);
		}

		if ($redirect && $stateOk) {
			$this->redirect('default');
		}

	}