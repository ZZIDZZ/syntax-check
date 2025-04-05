function Channel (id, exchange) {
  var self = this;
  events.EventEmitter.call(this);
  this.id = id;
  this.exchange = exchange;
  this.exchange.on(this.id, function (message) {
    self.emit('message', message);
  });
  this.setMaxListeners(0);
}