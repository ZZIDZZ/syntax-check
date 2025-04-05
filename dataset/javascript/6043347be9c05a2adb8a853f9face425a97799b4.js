function(fn) {
      fn = fn || console.log.bind(console);

      return this.toBase64(function(str) {
        fn('data:image/png;base64,' + str);
      });
    }