function assertParasite(fn) {
    return function _deeperAssert() {
      if (this._bailedOut) return;

      var res = fn.apply(tap.assert, arguments);
      this.result(res);
      return res;
    };
  }