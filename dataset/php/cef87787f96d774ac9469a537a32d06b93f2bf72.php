public function getReadableItems()
    {
        $readablesItems = [];

        foreach ($this->items as $key => $item) {
            array_push($readablesItems, $item->getReadableParameters());
        }

        return $readablesItems;
    }