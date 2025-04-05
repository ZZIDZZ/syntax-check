protected function getRecipients($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('smscru', $notification);

        if ($to === null || $to === false || $to === '') {
            return [];
        }

        return \is_array($to) ? $to : [$to];
    }