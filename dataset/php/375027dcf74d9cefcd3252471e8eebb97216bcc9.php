public function parseCommand(UserEventInterface $event, EventQueueInterface $queue)
    {
        // Get the pattern to identify commands
        if ($this->nick) {
            $nick = $event->getConnection()->getNickname();
            $identity = $this->getNickPattern($nick);
        } else {
            $identity = $this->identityPattern;
        }

        // Verify this event contains a command and remove the substring
        // identifying it as one
        $eventParams = $event->getParams();
        $target = $event->getCommand() === 'PRIVMSG'
            ? $eventParams['receivers']
            : $eventParams['nickname'];
        $message = $eventParams['text'];
        if ($identity) {
            if (preg_match($identity, $message, $match)) {
                $message = preg_replace($identity, '', $message);
            } elseif (preg_match($this->channelPattern, $target)) {
                return;
            }
        }

        // Parse the command and its parameters
        if (!preg_match($this->commandPattern, $message, $match)) {
            return;
        }
        $customCommand = $match['command'];
        if (!empty($match['params'])
            && preg_match_all($this->paramsPattern, $match['params'], $matches)) {
            $customParams = array_map(
                function($param) {
                    return trim($param, '"');
                },
                $matches[0]
            );
        } else {
            $customParams = array();
        }

        // Populate an event object with the parsed data
        $commandEvent = $this->getCommandEvent();
        $commandEvent->fromEvent($event);
        $commandEvent->setCustomCommand($customCommand);
        $commandEvent->setCustomParams($customParams);

        // Emit the event object to listeners
        $customEventName = 'command.' . strtolower($customCommand);
        $customEventParams = array($commandEvent, $queue);
        $this->getEventEmitter()->emit($customEventName, $customEventParams);
    }