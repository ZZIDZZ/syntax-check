function stopcock(fn, options) {
  options = Object.assign(
    {
      queueSize: Math.pow(2, 32) - 1,
      bucketSize: 40,
      interval: 1000,
      limit: 2
    },
    options
  );

  const bucket = new TokenBucket(options);
  const queue = [];
  let timer = null;

  function shift() {
    clearTimeout(timer);
    while (queue.length) {
      const delay = bucket.consume();

      if (delay > 0) {
        timer = setTimeout(shift, delay);
        break;
      }

      const data = queue.shift();
      data[2](fn.apply(data[0], data[1]));
    }
  }

  function limiter() {
    const args = arguments;

    return new Promise((resolve, reject) => {
      if (queue.length === options.queueSize) {
        return reject(new Error('Queue is full'));
      }

      queue.push([this, args, resolve]);
      shift();
    });
  }

  Object.defineProperty(limiter, 'size', { get: () => queue.length });

  return limiter;
}