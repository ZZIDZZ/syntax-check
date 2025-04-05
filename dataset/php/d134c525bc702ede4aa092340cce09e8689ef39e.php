protected function declareReplyToReplyStackMessaging()
    {
        $this->replyToReplyStack->on(EventsConstants::MESSAGE, function ($requestDto) {

            if ($this->getRequestForStartFromReplyStack === false) {

                $this->getRequestForStartFromReplyStack = true;

                $startReplyToReplyStack = new PulsarToReplyStackReplyDto();
                $startReplyToReplyStack->setSubscribersNumber($this->shouldBeSubscribersNumber);
                $startReplyToReplyStack->setDtoToTransfer(new BecomeTheSubscriberReplyDto());

                $this->replyToReplyStack->send(serialize($startReplyToReplyStack));

            } else {

                if ($this->replyStackReturnResult === false) {

                    $this->replyStackReturnResult = true;

                    /**
                     * @var ReplyStackToPulsarReturnResultRequestDto $requestDto
                     */
                    $requestDto = unserialize($requestDto);

                    if (!($requestDto instanceof ReplyStackToPulsarReturnResultRequestDto)) {
                        throw new PublisherPulsarException("Unexpected result from ReplyStack.");
                    }

                    $this->considerMeAsSubscriber = $requestDto->getConsiderMeAsSubscriber();

                    $this->logger->debug("PULSAR RECEIVE REPLY STACK RESULT INFO.");

                } else {
                    throw new PublisherPulsarException("Get replyStack result (info about subscribers) twice.");
                }
            }
        });

        $this->replyToReplyStack->on(EventsConstants::ERROR, function ($error) {
            $this->logger->debug(LoggingExceptions::getExceptionString($error));
        });

        return null;
    }