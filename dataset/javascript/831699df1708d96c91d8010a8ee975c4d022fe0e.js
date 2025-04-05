function Horseman(options) {
	this.ready = false;
	if (!(this instanceof Horseman)) { return new Horseman(options); }
	this.options = defaults(clone(options) || {}, DEFAULTS);

	this.id = ++instanceId;
	debug('.setup() creating phantom instance %s', this.id);

	var phantomOptions = {
		'load-images': this.options.loadImages,
		'ssl-protocol': this.options.sslProtocol
	};

	if (typeof this.options.ignoreSSLErrors !== 'undefined') {
		phantomOptions['ignore-ssl-errors'] = this.options.ignoreSSLErrors;
	}
	if (typeof this.options.webSecurity !== 'undefined') {
		phantomOptions['web-security'] = this.options.webSecurity;
	}
	if (typeof this.options.proxy !== 'undefined') {
		phantomOptions.proxy = this.options.proxy;
	}
	if (typeof this.options.proxyType !== 'undefined') {
		phantomOptions['proxy-type'] = this.options.proxyType;
	}
	if (typeof this.options.proxyAuth !== 'undefined') {
		phantomOptions['proxy-auth'] = this.options.proxyAuth;
	}
	if (typeof this.options.diskCache !== 'undefined') {
		phantomOptions['disk-cache'] = this.options.diskCache;
	}
	if (typeof this.options.diskCachePath !== 'undefined') {
		phantomOptions['disk-cache-path'] = this.options.diskCachePath;
	}
	if (typeof this.options.cookiesFile !== 'undefined') {
		phantomOptions['cookies-file'] = this.options.cookiesFile;
	}

	if (this.options.debugPort) {
		phantomOptions['remote-debugger-port'] = this.options.debugPort;
		phantomOptions['remote-debugger-autorun'] = 'no';
		if (this.options.debugAutorun !== false) {
			phantomOptions['remote-debugger-autorun'] = 'yes';
		}
	}

	Object.keys(this.options.phantomOptions || {}).forEach(function (key) {
		if (typeof phantomOptions[key] !== 'undefined') {
			debug('Horseman option ' + key + ' overridden by phantomOptions');
		}
		phantomOptions[key] = this.options.phantomOptions[key];
	}.bind(this));

	var instantiationOptions = {
		parameters: phantomOptions
	};

	if (typeof this.options.phantomPath !== 'undefined') {
		instantiationOptions['path'] = this.options.phantomPath;
	}

	// Store the url that was requested for the current url
	this.targetUrl = null;

	// Store the HTTP status code for resources requested.
	this.responses = {};

	this.tabs = [];
	this.onTabCreated = noop;
	this.onTabClosed = noop;

	this.ready = prepare(this, instantiationOptions);
}