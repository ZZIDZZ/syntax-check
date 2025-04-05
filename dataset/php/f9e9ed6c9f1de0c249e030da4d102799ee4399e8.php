public static function create($requiredName)
    {
        /**
         * Loop through the notification list and try to find a match by name
         */
        $notifications = Factory::getNotification();
        foreach ($notifications as $notificationName) {

            if ($notificationName === ucfirst($requiredName)) {
                $notificationClass = 'AbuseIO\\Notification\\' . $notificationName;

                // Collector is enabled, then return its object
                if (config("notifications.{$notificationName}.notification.enabled") === true) {

                    return new $notificationClass();

                } else {
                    Log::info(
                        'AbuseIO\Notification\Factory: ' .
                        "The notification {$notificationName} has been disabled and will not be used."
                    );

                    return false;
                }
            }
        }

        // No valid notifications found
        Log::info(
            'AbuseIO\Notification\Factory: ' .
            "The notification {$requiredName} is not present on this system"
        );
        return false;
    }