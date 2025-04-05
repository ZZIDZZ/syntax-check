function BufferingTracer(tracer, options) {
  options = options || {};

  var self = this;

  this._tracer = tracer;
  this._maxTraces = options.maxTraces || 50;
  this._sendInterval = options.sendInterval ? (options.sendInterval * 1000) : 10 * 1000;
  this._lastSentTs = Date.now();
  this._buffer = [];
  this._stopped = false;

  this._periodSendTimeoutId = setTimeout(this._periodicSendFunction.bind(this),
                                         this._sendInterval);
}