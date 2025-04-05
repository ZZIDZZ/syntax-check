function wrap(type, fn) {
    return function plugin() {
      return this.type === type ? fn.apply(this, arguments) : plugin;
    };
  }