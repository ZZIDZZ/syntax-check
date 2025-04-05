function memoize(fun) {
  // Making cache = {} an optional ES6 parameter breaks coverage. Why?

  /** @type {({ [key: string]: any })} */
  const cache = {};

  if (fun.length === 1) {
    return (/** @type {any} */ arg) => {
      if (arg in cache) {
        return cache[arg];
      }

      const result = fun(arg);
      cache[arg] = result;
      return result;
    };
  }

  return (/** @type {any} */ arg1, /** @type {any} */ arg2) => {
    if (cache[arg1] && arg2 in cache[arg1]) {
      return cache[arg1][arg2];
    }

    const result = fun(arg1, arg2);

    if (!cache[arg1]) {
      cache[arg1] = {};
    }

    cache[arg1][arg2] = result;

    return result;
  };
}