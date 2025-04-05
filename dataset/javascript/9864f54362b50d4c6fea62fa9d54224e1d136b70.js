function curry2 (fn, self) {
  var out = function () {
    if (arguments.length === 0) return out

    return arguments.length > 1
      ? fn.apply(self, arguments)
      : bind.call(fn, self, arguments[0])
  }

  out.uncurry = function uncurry () {
    return fn
  }

  return out
}