public static function flushCache()
    {
        // $value可以是callable或是值
        if (static::$cacheManager) {
            if (!static::$cacheManager->getAssistant()) {
                static::$cacheManager = static::$cacheManager->withTags(get_called_class());
            }

            static::$cacheManager->getAssistant()->flushCache();
        }
    }