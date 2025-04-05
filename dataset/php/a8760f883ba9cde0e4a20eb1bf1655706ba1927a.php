protected function getArrayableItems($items)
    {
        if ($items instanceof self) {
            return $items->all();
        } elseif (($items instanceof Arrayable || instance_of_laravel_arrayable($items))) {
            return $items->toArray();
        } elseif (($items instanceof Jsonable || instance_of_laravel_jsonable($items))) {
            return json_decode($items->toJson(), true);
        }

        return (array)$items;
    }