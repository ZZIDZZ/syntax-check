public static function handle(Error $error)
    {
        foreach (self::$writers as $class => $writer) {
            if (is_null($writer)) {
                self::$writers[$class] = $writer = new $class();
            }
            $writer->handle($error);
        }
    }