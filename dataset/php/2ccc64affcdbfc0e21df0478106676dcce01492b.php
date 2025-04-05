public function create($attributes) {
        $attributes = $this->modifyAttributesBeforeCreate($attributes);

        $model = $this->prototype_model->create($attributes);

        // broadcast create event
        if ($this->usesTrait(BroadcastsRepositoryEvents::class)) {
            $this->broadcastRepositoryEvent(new ModelCreated($model, $attributes));
        }

        return $model;
    }