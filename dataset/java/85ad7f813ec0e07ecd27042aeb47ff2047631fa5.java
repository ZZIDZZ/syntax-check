public ReceivedEmail[] get() {
		if (fromFolder != null) {
			session.useFolder(fromFolder);
		}

		return session.receiveMessages(filter, flagsToSet, flagsToUnset, envelopeOnly, messages -> {
			if (targetFolder != null) {
				try {
					session.folder.copyMessages(messages, session.getFolder(targetFolder));
				} catch (MessagingException e) {
					throw new MailException("Copying messages failed");
				}
			}
		});
	}