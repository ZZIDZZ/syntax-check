function create(prop) {
  if (typeof prop !== 'string') {
    throw new Error('expected the first argument to be a string.');
  }

  return function(app) {
    if (this.isRegistered('base-' + prop)) return;

    // map config
    var config = utils.mapper(app)
      // store/data
      .map('store', store(app.store))
      .map('data')

      // options
      .map('enable')
      .map('disable')
      .map('option')
      .alias('options', 'option')

      // get/set
      .map('set')
      .map('del')

    // Expose `prop` (config) on the instance
    app.define(prop, proxy(config));

    // Expose `process` on app[prop]
    app[prop].process = config.process;
  };

  function store(app) {
    if (!app) return {};
    var mapper = utils.mapper(app);
    app.define(prop, proxy(mapper));
    return mapper;
  }
}