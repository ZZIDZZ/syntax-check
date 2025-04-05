function bindArguments(func) {
  function binder() {
    return func.apply(this, args.concat(slice.call(arguments)));
  }

  var args = slice.call(arguments, 1);
  return binder;
}