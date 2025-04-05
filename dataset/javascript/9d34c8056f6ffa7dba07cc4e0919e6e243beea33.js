function pipe() {
    for (var _len6 = arguments.length, fs = Array(_len6), _key6 = 0; _key6 < _len6; _key6++) {
      fs[_key6] = arguments[_key6];
    }

    return function () {
      var _this3 = this;

      var first = fs.shift();

      for (var _len7 = arguments.length, args = Array(_len7), _key7 = 0; _key7 < _len7; _key7++) {
        args[_key7] = arguments[_key7];
      }

      return fs.reduce(function (acc, f) {
        return f.call(_this3, acc);
      }, first.apply(this, args));
    };
  }