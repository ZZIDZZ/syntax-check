protected synchronized void purgeLogger(FluentLogger logger) {
		Iterator<Entry<FluentLogger, String>> it = loggers.entrySet().iterator();
		while (it.hasNext()) {
			if (it.next().getKey() == logger) {
				it.remove();
				return;
			}
		}
	}