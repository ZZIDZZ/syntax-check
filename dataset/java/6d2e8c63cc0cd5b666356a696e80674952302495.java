public Object executeOutboundOperation(final Message<?> message) {

		try {
			String serializedMessage = messageMarshaller.serialize(message);

			if (snsTestProxy == null) {
				PublishRequest request = new PublishRequest();
				PublishResult result = client.publish(request.withTopicArn(
						topicArn).withMessage(serializedMessage));
				log.debug("Published message to topic: "
						+ result.getMessageId());
			} else {
				snsTestProxy.dispatchMessage(serializedMessage);
			}

		} catch (MessageMarshallerException e) {
			log.error(e.getMessage(), e);
			throw new MessagingException(e.getMessage(), e.getCause());
		}

		return message.getPayload();
	}