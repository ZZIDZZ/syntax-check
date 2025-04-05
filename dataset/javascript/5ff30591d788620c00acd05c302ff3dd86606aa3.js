function TorAgent(opts) {
  if (!(this instanceof TorAgent)) {
    return new TorAgent();
  }

  http.Agent.call(this, opts);

  this.socksHost   = opts.socksHost || 'localhost';
  this.socksPort   = opts.socksPort || 9050;
  this.defaultPort = 80;

  // Used when invoking TorAgent.create
  this.tor = opts.tor;

  // Prevent protocol check, wrap destroy
  this.protocol = null;
  this.defaultDestroy = this.destroy;
  this.destroy = this.destroyWrapper;
}