function getFetchByStateCallback(callback) {
            return function(err, data) {
                if (err) {
                    asyncErrors.push(err);
                }
                callback(null, data);
            };
        }