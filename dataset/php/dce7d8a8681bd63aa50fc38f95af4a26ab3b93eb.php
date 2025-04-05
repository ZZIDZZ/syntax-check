public function getModels($columns = ['*'])
    {
        $results = $this->query->get($columns);

        $connection = $this->model->getConnectionName();

        // Check for joined relations
        if (!empty($this->joined)) {
            foreach ($results as $key => $result) {
                $relation_values = [];

                foreach ($result as $column => $value) {
                    Arr::set($relation_values, $column, $value);
                }

                foreach ($this->joined as $relationName) {
                    $relation = $this->getRelation($relationName);

                    $relation_values[$relationName] = $relation->getRelated()->newFromBuilder(
                        Arr::pull($relation_values, $relationName),
                        $connection
                    );
                }

                $results[$key] = $relation_values;
            }
        }

        return $this->model->hydrate($results, $connection)->all();
    }