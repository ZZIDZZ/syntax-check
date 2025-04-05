function call(name, isLong) {

	var obj = isLong ? long[name] : short[name];
	if (!obj)
		return error(`Unknown argument '${name}'`);

	if (n + obj.length > count)
		return error(`Too few arguments after '${name}'`);

	var arr = process.argv.slice(n, n + obj.length);
	n += obj.length;

	obj.callback(arr);
}