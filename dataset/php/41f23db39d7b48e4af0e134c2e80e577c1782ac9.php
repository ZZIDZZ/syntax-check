public static function factory($type)
    {
        $classname = get_called_class();
        switch ($type) {
            case self::TYPE_NATIVE:
                $adapter = new NativeAdapter();
                break;
            case self::TYPE_EXIFTOOL:
                $adapter = new ExiftoolAdapter();
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf('Unknown type "%1$s"', $type)
                );
        }
        return new $classname($adapter);
    }