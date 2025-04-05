function(prop, desc, type) {
		var defaults = {
			enumerable: true,
			configurable: true
		}
		, fn
		, camelType
		, self = this
		;

		type = type.toLowerCase();
		camelType = type.replace(/^[gs]/, function($1) { return $1.toUpperCase(); });

		// define function object for fallback
		if (o.typeOf(desc) === 'function') {
			fn = desc;
			desc = {};
			desc[type] = fn;
		} else if (o.typeOf(desc[type]) === 'function') {
			fn = desc[type];
		} else {
			return;
		}

		if (Env.can('define_property')) {
			if (Object.defineProperty) {
				return Object.defineProperty(this, prop, o.extend({}, defaults, desc));
			} else {
				return self['__define' + camelType + 'ter__'](prop, fn);
			}
		}
	}