public void stop() throws ShutDownException {
    if (rabbitMqProcess == null) {
      throw new IllegalStateException("Stop shouldn't be called unless 'start()' was successful.");
    }
    new ShutdownHelper(config, rabbitMqProcess).run();
    rabbitMqProcess = null;
  }