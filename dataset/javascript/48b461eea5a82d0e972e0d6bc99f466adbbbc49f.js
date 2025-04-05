function Toxy (opts) {
  if (!(this instanceof Toxy)) return new Toxy(opts)

  opts = Object.assign({}, Toxy.defaults, opts)
  Proxy.call(this, opts)

  this.routes = []
  this._rules = midware()
  this._inPoisons = midware()
  this._outPoisons = midware()

  setupMiddleware(this)
}