function MultiKeyCache(options) {
  options = options || {};

  var self = this;
  var dispose = options.dispose;

  options.dispose = function (key, value) {
    self._dispose(key);
    if (dispose) { dispose(key, value); }
  };

  this.cache = new LRU(options);
  this._keyMap = {};
}