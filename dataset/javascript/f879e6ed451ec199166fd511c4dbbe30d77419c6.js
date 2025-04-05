function keyblade (obj, opts) {
  opts = Object.assign({
    message: _defaultMessage,
    logBeforeThrow: true,
    ignore: []
  }, opts)
  opts.ignore = (opts.ignore && Array.isArray(opts.ignore)) ? opts.ignore : []

  return new Proxy(obj, {
    get (target, propKey, receiver) {
      const useGetter = Reflect.has(target, propKey, receiver) || _isReserved(propKey, opts.ignore)
      if (useGetter) {
        return Reflect.get(target, propKey, receiver)
      }

      // Leave symbols alone.
      if (typeof propKey === 'symbol') {
        return Reflect.get(target, propKey, receiver)
      }

      const message = opts.message(propKey)
      if (opts.logBeforeThrow) {
        if (typeof opts.logBeforeThrow === 'function') {
          opts.logBeforeThrow(message, propKey)
        } else {
          console.error(message)
        }
      }

      throw new UndefinedKeyError(message)
    }
  })
}