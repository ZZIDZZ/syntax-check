function(describe) {
		if (!Array.isArray(describe.m)) {
			return when.reject('no modules in describe message');
		}

		var allDeps = [];
		var modules = describe.m;

		for(var i=0;i<modules.length;i++) {
			var checkModule = modules[i];

			// don't look for dependencies of things that don't have dependencies.
			// they'll never cause safe mode as a result of their requirements,
			// and they're probably referenced by other things

			for(var d = 0; d < checkModule.d.length; d++) {
				var moduleNeeds = checkModule.d[d];

				// what things do we need that we don't have?
				var deps = this._walkChain(modules, moduleNeeds);
				if (deps && (deps.length > 0)) {
					allDeps = allDeps.concat(deps);
				}
			}
		}

		var keyFn = function(dep) {
			// todo - location should also be taken into account
			return [dep.f, dep.n, dep.v].join('_');
		};
		return utilities.dedupArray(allDeps, keyFn);
	}