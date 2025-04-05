function copyToClient(req, res) {
        return httpGet({
          hostname: t.options.remoteClientHostname,
          port: t.options.remoteClientPort,
          path: req.originalUrl,
          method: 'GET'
        }).then(function (obj) {
          var contentType = getContentType(obj.response);
          if (contentType) res.set("Content-Type", contentType);
          res.send(obj.data);
        });
      }