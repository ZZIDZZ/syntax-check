final public function count(Record $record): int
    {
        $alias = 'count';
        $collection = $this->getCollection();
        $name = $this->getPrimaryKey();
        $type = Field::AGGREGATOR_COUNT;
        $options = ['alias' => $alias];
        $fields = [Field::make($collection, $name, $type, $options)];

        $this->reset();

        $count = $this
            ->fields($fields)
            ->limit(null)
            ->read($record, null, false)
            ->current();

        $this->reset();

        if (!$count->has($alias)) {
            throw new SimplesActionError(get_class($this), $alias);
        }

        return (int)$count->get($alias);
    }