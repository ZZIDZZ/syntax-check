function (req, res, next) {            
                if(req.url.indexOf('.') === -1 && req.url.indexOf(startDir) > -1){
                    req.url = startPath;
                }
                
                return next();
            }