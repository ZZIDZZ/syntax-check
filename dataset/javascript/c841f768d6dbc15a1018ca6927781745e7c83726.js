function(file) {
    debug('lexing <%s>', this.file.path);
    if (file) this.file = file;
    this.init();
    while (this.input) this.next();
    return this.ast;
  }