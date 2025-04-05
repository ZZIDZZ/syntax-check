public function getUser(IncomingMessage $matchingMessage)
    {
        $payload = $matchingMessage->getPayload();

        return new User($payload->get('message')['from']['id'], $payload->get('message')['from']['name'], null,
            $payload->get('message')['from']['mention_name']);
    }