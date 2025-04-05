function requireRole(requiredRole) {
    return function(req, res, next) {
      if(!req.user) {
        return next(superloginError);
      }
      var roles = req.user.roles;
      if(!roles || !roles.length || roles.indexOf(requiredRole) === -1) {
        res.status(forbiddenError.status);
        res.json(forbiddenError);
      } else {
        next();
      }
    };
  }