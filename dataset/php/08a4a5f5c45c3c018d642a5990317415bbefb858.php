public static function registerSubTypeEnum(string $subTypeEnumClass, string $subTypeEnumValueRegexp): bool
    {
        if (!static::hasSubTypeEnum($subTypeEnumClass, $subTypeEnumValueRegexp)) {
            // registering same subtype enum class but with different regexp cause exception in following method
            return static::addSubTypeEnum($subTypeEnumClass, $subTypeEnumValueRegexp);
        }

        return false;
    }