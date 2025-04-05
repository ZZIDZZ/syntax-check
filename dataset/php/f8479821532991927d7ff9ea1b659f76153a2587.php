private static function isIntervalAllDay(Time $start, Time $end): bool
    {
        if ($start->getHours() !== 0 || $start->getMinutes() !== 0 || $start->getSeconds() !== 0) {
            return false;
        }

        if ($end->getHours() !== 24 || $end->getMinutes() !== 0 || $end->getSeconds() !== 0) {
            return false;
        }

        return true;
    }