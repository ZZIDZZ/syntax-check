private function doPersist()
    {
        if (!$this->model->getMeta(ModelInterface::IS_CHANGED)) {
            return;
        }

        $this->handlePrePersist();

        // TO DO: manual sorting property handling is not enabled here as it originates from the backend defininiton.
        // Save the model.
        $dataProvider = $this->environment->getDataProvider($this->model->getProviderName());

        $dataProvider->save($this->model);

        $this->handlePostPersist();

        $this->storeVersion($this->model);
    }