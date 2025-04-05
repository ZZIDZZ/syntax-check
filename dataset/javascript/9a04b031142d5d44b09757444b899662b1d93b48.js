function setCallback(cb) {
    if (canExecute) {
      if (Object.getPrototypeOf(cb) === Function.prototype) {
        callback = cb;
        jn.logCreationEvent(id, 'INFO', 'callback definition completed', (new Date()).toJSON());
      } else {
        setCanExecute(false);
        jn.logCreationEvent(id, 'ERROR', 'callback definition failed', (new Date()).toJSON());
      }
    }
  }