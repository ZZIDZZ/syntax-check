function fm(options) {
    var Module = fm.modules[options.module];
    if (Module) {
      return new Module(options);
    }
    throw new Error("Unable to find module '" + options.module + "'");
  }