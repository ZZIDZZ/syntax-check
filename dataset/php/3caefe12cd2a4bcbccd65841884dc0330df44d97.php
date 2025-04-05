public static function release($file)
    {
        if ($file instanceof StreamInterface) {
            $file = 'spiral://' . spl_object_hash($file);
        }

        unset(self::$uris[$file]);
    }