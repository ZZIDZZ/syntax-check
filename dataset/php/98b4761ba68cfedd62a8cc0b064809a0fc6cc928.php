public function consume($message, array $headers = [])
    {
        return $this->serializer->serialize(
            $this->consumer->consume(
                $this->serializer->deserialize($message),
                $headers
            )
        );
    }