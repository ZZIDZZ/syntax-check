protected function resourceToArray($data)
    {
        if ($data instanceof ResourceCollection) {
            return $data->toArray();
        } else if ($data instanceof RESTResource) {
            return $data->toArray();
        } else if (ArrayHelper::isIterable($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = $this->resourceToArray($v);
            }
            return $data;
        }

        return $data;
    }