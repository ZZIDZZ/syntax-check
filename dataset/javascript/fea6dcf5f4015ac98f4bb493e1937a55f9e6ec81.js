function Back(options) {
  if (!(this instanceof Back)) {
    return new Back(options);
  }

  this.settings = extend(options);
  this.reconnect = null;
}