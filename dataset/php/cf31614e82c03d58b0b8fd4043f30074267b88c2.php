protected function modifyUploadableBehavior()
    {
        $table = $this->getTable();

        if ($table->hasBehavior('uploadable')) {
            $uploadable = $table->getBehavior('uploadable');
            $parameters = $uploadable->getParameters();
            $up_columns = explode(',', $parameters['columns']);

            foreach (array_keys($this->getColumns()) as $column) {
                foreach ($up_columns as $up_column) {
                    if (trim($up_column) == $column) {
                        continue 2;
                    }
                }

                $up_columns[] = $column;
            }

            $parameters['columns'] = implode(',', $up_columns);
            $uploadable->setParameters($parameters);
        } else {
            $uploadable = new UploadableBehavior();
            $uploadable->setName('uploadable');
            $uploadable->setParameters(array(
                'columns' => implode(',', array_keys($this->getColumns()))
            ));

            $table->addBehavior($uploadable);
        }
    }