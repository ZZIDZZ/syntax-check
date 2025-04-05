function _log(level) {

  return function() {
    var meta = null;
    var args = arguments;
    if (arguments.length === 0) {
      // we only check here current level, but we also should more but restify uses it only for trace checks
      return this._winston.level === level;
    } else if (arguments[0] instanceof Error) {
      // winston supports Error in meta, so pass it as last
      meta = arguments[0].toString();
      args = Array.prototype.slice.call(arguments, 1);
      args.push(meta);
    } else if (typeof (args[0]) === 'string') {
      // just arrayize for level
      args = Array.prototype.slice.call(arguments);
    } else {
      // push provided object as meta
      meta = arguments[0];
      args = Array.prototype.slice.call(arguments, 1);
      args.push(meta);
    }
    args.unshift(level);
    this._winston.log.apply(this._winston, args);
  }
}