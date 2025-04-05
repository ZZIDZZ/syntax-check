function() {
        return function(req, res, next) {
            var jwt = req[this.options.reqProperty] || {};
            
            if (!jwt.valid) {
                next(new JWTExpressError('JWT is invalid'));
            } else {
                next();
            }
        }.bind(this);
    }