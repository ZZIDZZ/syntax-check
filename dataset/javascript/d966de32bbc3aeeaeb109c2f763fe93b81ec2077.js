function Router(options) {
	const logPrefix = topLogPrefix + 'Router() - ';
	const that      = this;

	let defaultRouteFound = false;

	that.options = options || {};

	if (! that.options.paths) {
		that.options.paths = {
			'controller': {
				'path': 'controllers',
				'exts': 'js'
			},
			'static': {
				'path': 'public',
				'exts': false
			},
			'template': {
				'path': 'public/templates',
				'exts': ['tmpl', 'tmp', 'ejs', 'pug']
			}
		};
	}

	if (! that.options.routes)   that.options.routes   = [];
	if (! that.options.basePath) that.options.basePath = process.cwd();

	if (! that.options.log) {
		const lUtils = new LUtils();

		that.options.log = new lUtils.Log();
	}

	for (const key of Object.keys(that.options.paths)) {
		if (! Array.isArray(that.options.paths[key].exts) && that.options.paths[key].exts !== false) {
			that.options.paths[key].exts = [that.options.paths[key].exts];
		}
	}

	if (! that.options.lfs) {
		that.options.lfs = new Lfs({'basePath': that.options.basePath, 'log': that.options.log});
	}

	for (let i = 0; that.options.routes[i] !== undefined; i ++) {
		if (that.options.routes[i].regex === '^/$') {
			defaultRouteFound = true;
			break;
		}
	}

	// We should always have a default route, so if none exists, create one
	if (defaultRouteFound === false) {
		that.options.routes.push({
			'regex':          '^/$',
			'controllerPath': 'default.js',
			'templatePath':   'default.tmpl'
		});
	}

	for (const key of Object.keys(that.options)) {
		that[key] = that.options[key];
	}

	that.log.debug(logPrefix + 'Instantiated with options: ' + JSON.stringify(that.options));
}