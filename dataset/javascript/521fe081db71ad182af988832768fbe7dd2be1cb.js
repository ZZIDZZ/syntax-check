function onerror(err) {
      var handlers = emitter._events.error

      cleanup()

      // Cannot use `listenerCount` in node <= 0.12.
      if (!handlers || handlers.length === 0 || handlers === onerror) {
        throw err // Unhandled stream error in pipe.
      }
    }