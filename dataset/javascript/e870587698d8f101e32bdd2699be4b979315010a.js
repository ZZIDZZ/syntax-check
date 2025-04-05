function _wrapIntercept(func, stream, opts, exec) {
  var idex = Number(arguments.length > 3);
  var args = _shift(arguments[idex + 1], arguments[idex + 2]);

  opts = args[0];
  exec = args[1];

  opts.quiet = true;

  return idex
    ? func(stream, opts, exec)
    : func(opts, exec);
}