public static function clear($mode = null)
    {
        if (is_numeric($mode)) {
            $mode = self::TYPE_CLASS | self::TYPE_OBJECT;
        }

        if ($mode & self::TYPE_CLASS) {
            self::$classReflections = array();
        }

        if ($mode & self::TYPE_OBJECT) {
            self::$objectReflections = array();
        }
    }