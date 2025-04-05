public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['source'] === null) {
            $invalid_properties[] = "'source' can't be null";
        }
        if ($this->container['destinations'] === null) {
            $invalid_properties[] = "'destinations' can't be null";
        }
        return $invalid_properties;
    }