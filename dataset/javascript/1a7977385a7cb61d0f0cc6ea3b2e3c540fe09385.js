function(err) {
      if (err) return done(err);

      var ret;
      if (typeof leave == 'function') {
        try {
          ret = leave.call(this, child, parent);
        } catch (err) {
          return done(err);
        }
      }

      done(null, ret);
    }