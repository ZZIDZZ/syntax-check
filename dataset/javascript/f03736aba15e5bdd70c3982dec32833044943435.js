function prewatch(theOptions) {
			if (config.watch) {
				return _.defaults(theOptions, watchify.args);
			}
			return theOptions;
		}