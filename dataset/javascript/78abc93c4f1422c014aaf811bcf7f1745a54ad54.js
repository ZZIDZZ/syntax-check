function ReconnectingWebSocket(url, opts) {
    if (!(this instanceof ReconnectingWebSocket)) {
      throw new TypeError('Cannot call a constructor as a function');
    }

    opts = opts || {};

    var self = this;
    function getOpt(name, def) {
      return opts.hasOwnProperty(name)? opts[name] : def;
    }
    var timeout = getOpt('timeout', 100);
    var maxRetries = getOpt('maxRetries', 5);
    var curRetries = 0;

    // External event callbacks
    self.onmessage = noop;
    self.onopen = noop;
    self.onclose = noop;

    function unreliableOnOpen(e) {
      self.onopen(e);
      curRetries = 0;
    }

    function unreliableOnClose(e) {
      self.onclose(e);

      if (curRetries < maxRetries) {
        ++curRetries;
        setTimeout(connect, timeout);
      }
    }

    function unreliableOnMessage(e) {
      self.onmessage(e);
    }

    function connect() {
      // Constructing a WebSocket() with opts.protocols === undefined
      // does NOT behave the same as calling it with only one argument
      // (specifically, it throws security errors).
      if (opts.protocols) {
        self.ws = new WebSocket(url, opts.protocols);
      } else {
        self.ws = new WebSocket(url);
      }

      // onerror isn't necessary: it is always accompanied by onclose
      self.ws.onopen = unreliableOnOpen;
      self.ws.onclose = unreliableOnClose;
      self.ws.onmessage = unreliableOnMessage;
    }

    connect();
    this.connect = connect;
  }