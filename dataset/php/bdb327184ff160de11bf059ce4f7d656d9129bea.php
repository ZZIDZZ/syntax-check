public function getWhereIdInWithKeys(array $ids)
    {
        $models = $this->getWhereIdIn($ids);

        $returning = [];
        foreach ($models as $model) {
            $returning[$model->getId()] = $model;
        }

        return $returning;
    }