private function encodeUTF8($object)
    {
        if (\is_array($object)) {
            return array_map([$this, 'encodeUTF8'], $object);
        }

        return mb_convert_encoding((string) $object, 'UTF-8', 'auto');
    }