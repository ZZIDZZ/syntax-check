function mergeAll(safe, obj) {
	let args = toArray(arguments).slice(2);
	for (let i = 0; i < args.length; i++) {
		obj = merge(obj, args[i], safe);
	}
	return obj;
}