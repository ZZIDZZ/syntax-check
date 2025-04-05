function(req, cb) {
    req = request.normalizeRequest(req);

    var page;
    try {
      page = this.createPageForRequest(req);
    } catch(err) {
      if (cb)
        return cb(err)
      else
        throw err;
    }

    var needData = typeof page.fetchData === 'function' && !this.state.request.data;

    if (request.isEqual(this.state.request, req) && !needData)
      return;

    fetchDataForRequest(this, page, req, function(err, req) {
      if (err) {
        if (cb)
          return cb(err)
        else
          throw err;
      }
      this.setState({request: req, page: page});
    }.bind(this));
  }