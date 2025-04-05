function hook() {
	var self = this;
	argy(arguments)
		.ifForm('', function() {})
		.ifForm('string function', function(hook, callback) { // Attach to one hook
			if (!self._hooks[hook]) self._hooks[hook] = [];
			self._hooks[hook].push({cb: callback});
		})
		.ifForm('string string function', function(hook, id, callback) { // Attach a named hook
			if (!self._hooks[hook]) self._hooks[hook] = [];
			self._hooks[hook].push({id: id, cb: callback});
		})
		.ifForm('string array function', function(hook, prereqs, callback) { // Attach to a hook with prerequisites
			if (!self._hooks[hook]) self._hooks[hook] = [];
			self._hooks[hook].push({prereqs: prereqs, cb: callback});
		})
		.ifForm('string string array function', function(hook, id, prereqs, callback) { // Attach a named hook with prerequisites
			if (!self._hooks[hook]) self._hooks[hook] = [];
			self._hooks[hook].push({id: id, prereqs: prereqs, cb: callback});
		})
		.ifForm('array function', function(hooks, callback) { // Attach to many hooks
			hooks.forEach(function(hook) {
				if (!self._hooks[hook]) self._hooks[hook] = [];
				self._hooks[hook].push({cb: callback});
			});
		})
		.ifFormElse(function(form) {
			throw new Error('Unknown call style for .on(): ' + form);
		});

	return self;
}