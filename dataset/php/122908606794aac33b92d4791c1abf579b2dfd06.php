public static function createHashMap(array $items): HashMapInterface {
        $hashMapItems = [];

        foreach ($items as $itemKey => $itemValue) {
            $hashMapItems[] = new HashMapItem($itemKey, $itemValue);
        }

        return new HashMap($hashMapItems);
    }