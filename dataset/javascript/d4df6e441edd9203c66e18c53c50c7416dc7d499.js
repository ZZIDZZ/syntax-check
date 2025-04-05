function getIgnored(filepath) {
      for (var i in options.ignore) {
        if (filepath.indexOf(options.ignore[i]) !== -1) {
          return options.ignore[i];
        }
      }
      return null;
    }