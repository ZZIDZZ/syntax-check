function createApplication() {
  function app(req, res) { app.handle(req, res); }
  utils.merge(app, application);
  utils.merge(app, EventEmitter.prototype);
  app.request = { __proto__ : req };
  app.response = { __proto__ : res };
  app.init();
  return app;
}