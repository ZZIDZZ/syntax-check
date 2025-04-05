function parseValue(value) {
	if (_.isArray(value))
		return converters.list(value);
	else if (_.isPlainObject(value))
		return converters.map(value);
	else
		return value;
}