function _resolve(routes, path, req, res) {
	return Q.fcall(function() {

		path = path || [];

		var obj = routes;
		
		// Resolve promises first
		if(IS.obj(obj) && IS.fun(obj.then)) {
			var p = obj.then(function(ret) {
				return _resolve(ret, path, req, res);
			});
			return p;
		}

		// Resolve functions first
		if(IS.fun(obj)) {
			var p2 = Q.when(obj(req, res)).then(function(ret) {
				return _resolve(ret, path, req, res);
			});
			return p2;
		}
		
		// If the resource is undefined, return flags.notFound (resulting to a HTTP error 404).
		if(obj === undefined) {
			return flags.notFound;
		}
		
		// If path is at the end, then return the current resource.
		if(path.length === 0) {
			return obj;
		}
		
		// Handle arrays
		if(IS.array(obj)) {
			var k = path[0],
			    n = parseInt(path.shift(), 10);
			if(k === "length") {
				return _resolve(obj.length, path.shift(), req, res);
			}
			if(k !== ""+n) {
				return Q.fcall(function() { throw new errors.HTTPError({'code':400, 'desc':'Bad Request'}); });
			}
			return _resolve(obj[n], path.shift(), req, res);
		}
		
		// Handle objects
		if(IS.obj(obj)) {
			var k2 = path[0];
			if(obj[k2] === undefined) {
				return flags.notFound;
			}
			if(!obj.hasOwnProperty(k2)) {
				return Q.fcall(function() { throw new errors.HTTPError({'code':403, 'desc':'Forbidden'}); });
			}
			return _resolve(obj[path.shift()], path, req, res);
		}
		
		// Returns notFound because we still have keys in the path but nowhere to go.
		return flags.notFound;
	});
}