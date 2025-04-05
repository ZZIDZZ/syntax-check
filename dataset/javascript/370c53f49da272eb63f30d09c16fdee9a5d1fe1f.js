function(tickRate){
    events.EventEmitter.call(this);

    // Initialize private properties
    this._milliseconds = 0;
    this._setState('stopped');
    this._timer = new NanoTimer();

    tickRate = tickRate || 100;
    Object.defineProperty(this, 'tickRate', {
        enumerable: true,
        configurable: false,
        writable: false,
        value: tickRate
    });
}