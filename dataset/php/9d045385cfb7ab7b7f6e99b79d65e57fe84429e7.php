public static function getKeyValuesByType($keyType)
    {
        $keyvalues = self::getKeyvaluesByKeyType($keyType);

        // Sort through the enums of the found type and reformat those
        // as a keyvalue => keyname list.
        $list = [];

        /** @var Keyvalue $keyvalue */
        foreach ($keyvalues as $keyvalue) {
            $list[$keyvalue->keyvalue] = $keyvalue->keyname;
        }

        return $list;
    }