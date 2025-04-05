function Limon (input, options) {
  if (!(this instanceof Limon)) {
    return new Limon(input, options)
  }

  lazy.use(this, {
    fn: function (app, opts) {
      app.options = lazy.utils.extend(app.options, opts)
    }
  })

  this.defaults(input, options)
  this.use(lazy.plugin.prevNext())
}