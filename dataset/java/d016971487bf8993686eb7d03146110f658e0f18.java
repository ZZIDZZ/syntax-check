void e(String message, Object... args) {
    messenger.printMessage(ERROR, formatString(message, args));
  }