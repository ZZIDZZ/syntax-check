public function save()
    {
        if (empty($this->_owner)) {
            $this->addError('owner', "You can't use Seo model without owner");
            return false;
        }
        $this->model_id = $this->_owner->getPrimaryKey();
        $command = $this->_owner->getDb()->createCommand();
        $attributes = ['title', 'keywords', 'description'];
        $tableName = self::tableName($this->_owner);
        if ($this->_isNewRecord) {
            if (empty(array_filter($this->getAttributes($attributes)))) {
                // don't save new SEO data with empty values
                return true;
            }
            $command->insert($tableName, $this->toArray());
        } else {
            $command->update(
                $tableName, $this->toArray($attributes),
                ['model_id' => $this->model_id, 'condition' => $this->condition]
            );
        }
        $command->execute();
        $this->_isNewRecord = false;
        return true;
    }