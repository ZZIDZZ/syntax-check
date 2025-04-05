function map(arr, callback) {
		var wrapper = this;
		if (this.isAsync) {
			async.map(arr, function(item, cb) {
				wrapper.call(item, cb);
			}, callback);
		} else {
			callback(null, arr.map(function(item) {
				return wrapper.call(item);
			}));
		}
	}