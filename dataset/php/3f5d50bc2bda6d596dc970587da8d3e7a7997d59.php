private function groupByField($name)
    {
        $collection = $this->getNewCollection();
        foreach ($this as $entity) {
            if (!isset($entity->$name) || $entity->$name === null) {
                continue; //when entity dosen't have set property it will be omitted
            }

            $value = $entity->$name;

            if (!isset($collection[$value])) {
                $collection[$value] = $this->getNewCollection();
            }
            $collection[$value]->append($entity);
        }
        return $collection;
    }