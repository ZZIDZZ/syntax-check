public static function createFromConsoleEvent(BaseConsoleEvent $e, $startTime = null, $executionTime = null)
    {
        if (static::support($e)) {
            return new static($e, $startTime, $executionTime);
        } else {
            throw \InvalidArgumentException('Invalid event type.');
        }
    }