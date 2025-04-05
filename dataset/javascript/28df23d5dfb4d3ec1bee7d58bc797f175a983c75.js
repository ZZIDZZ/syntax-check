function series() {
  const tasks = Array.prototype.slice.call(arguments);
  var fn = cb => cb();

  if (typeof tasks[tasks.length - 1] === 'function')
    fn = tasks.pop();

  return (cb) => {
    const tasks_with_cb = tasks.concat([(err) => {
      if (err) return cb(err);
      fn(cb);
    }]);

    runSequence.apply(this, tasks_with_cb);
  }
}