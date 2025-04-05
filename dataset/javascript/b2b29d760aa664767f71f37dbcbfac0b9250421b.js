function shimmer (options) {
  if (options && options.logger) {
    if (!isFunction(options.logger)) logger("new logger isn't a function, not replacing")
    else logger = options.logger
  }
}