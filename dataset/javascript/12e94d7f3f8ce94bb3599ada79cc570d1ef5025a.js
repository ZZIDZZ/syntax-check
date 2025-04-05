function apply (func, args, self) {
  return (typeof func === 'function')
    ? func.apply(self, array(args))
    : func
}