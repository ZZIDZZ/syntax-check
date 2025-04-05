function(options) {
  options = _.defaults({}, options || {}, {
    tags:   {},
    drain:  undefined
  });
  assert(options.drain,                     "options.drain is required");
  assert(typeof options.tags === 'object',  "options.tags is required");
  assert(_.intersection(
    _.keys(options.tags), series.APIClientCalls.columns()
  ).length === 0, "Can't used reserved tag names!");

  // Create a reporter
  return series.APIClientCalls.reporter(options.drain, options.tags);
}