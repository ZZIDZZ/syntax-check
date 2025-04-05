function Connection(socket, parent) {

  logger('new Connection to %s', parent.type);
  this.id = uuid();
  this.socket = socket;
  this.parent = parent;
  this.responseHandlers = {};
  if (this.parent.browser) {
    this.socket.onmessage = this.message.bind(this);
    this.socket.onclose = socketClosed.bind(this);
    this.socket.onerror = socketError.bind(this);
  }
  else {
    this.socket.on('message', this.message.bind(this));
    this.socket.once('close', this.close.bind(this));
    this.socket.once('error', this.close.bind(this));
  }
}