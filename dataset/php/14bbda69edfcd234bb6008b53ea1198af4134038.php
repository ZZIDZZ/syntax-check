public function getItems($itemType = null): array
    {
        $items = $this->items;

        if (!is_null($itemType)) {
            $items = array_filter(
                $items,
                function ($item) use ($itemType) {
                    /* @var $item CartItemInterface */
                    return is_a($item, $itemType);
                }
            );
        }

        return $items;
    }