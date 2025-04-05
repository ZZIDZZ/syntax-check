public function BaseActionsInfoTraitInit()
    {
        /** @var ActiveRecord|self $this */
        foreach ($this->blameableAttributes as $eventName => $attributes) {
            $this->on(
                $eventName,
                [$this, 'evaluateAttributesInternal'],
                [
                    'attributes' => $attributes,
                    'methodName' => 'getBlameableValue',
                ]
            );
        }
        foreach ($this->timestampAttributes as $eventName => $attributes) {
            $this->on(
                $eventName,
                [$this, 'evaluateAttributesInternal'],
                [
                    'attributes' => $attributes,
                    'methodName' => 'getTimestampValue',
                ]
            );
        }
    }