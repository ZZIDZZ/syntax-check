function setupClient(cb) {
    cb = once(cb);

    // Indicate failure if anything goes awry during setup
    function bail(err) {
      socket.destroy();
      cb(err || new Error('client error during setup'));
    }
    // Work around lack of close event on tls.socket in node < 0.11
    ((socket.socket) ? socket.socket : socket).once('close', bail);
    socket.once('error', bail);
    socket.once('end', bail);
    socket.once('timeout', bail);

    self._socket = socket;
    self._tracker = tracker;

    // Run any requested setup (such as automatically performing a bind) on
    // socket before signalling successful connection.
    // This setup needs to bypass the request queue since all other activity is
    // blocked until the connection is considered fully established post-setup.
    // Only allow bind/search/starttls for now.
    var basicClient = {
      bind: function bindBypass(name, credentials, controls, callback) {
        return self.bind(name, credentials, controls, callback, true);
      },
      search: function searchBypass(base, options, controls, callback) {
        return self.search(base, options, controls, callback, true);
      },
      starttls: function starttlsBypass(options, controls, callback) {
        return self.starttls(options, controls, callback, true);
      },
      unbind: self.unbind.bind(self)
    };
    vasync.forEachPipeline({
      func: function (f, callback) {
        f(basicClient, callback);
      },
      inputs: self.listeners('setup')
    }, function (err, res) {
      if (err) {
        self.emit('setupError', err);
      }
      cb(err);
    });
  }