public function data($data = null)
    {
        if (is_array($data)) {
            if ($this->data && $this->data instanceof PayloadData) {
                $data = array_merge($this->data->toArray(), $data);
            }
            $data = (new PayloadDataBuilder())->setData($data);
        }

        if ($data instanceof PayloadData) {
            $this->data = $data;
        } elseif ($data instanceof PayloadDataBuilder) {
            $this->data = $data->build();
        } elseif (! is_null($data)) {
            throw static::makeInvalidArgumentException(
                $data,
                'data',
                PayloadData::class,
                PayloadDataBuilder::class
            );
        }

        return $this;
    }