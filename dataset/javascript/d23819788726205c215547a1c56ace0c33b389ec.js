function map(obj, source, target, isRecursive = true) {
	// Check if parameters have invalid types
	if ((typeof obj) != "object") throw new TypeError("The object should be JSON");
	if ((typeof source) != "string" && (typeof source) != "array") throw new TypeError("Source should be aither string or array");
	if ((typeof target) != "string" && (typeof target) != "array") throw new TypeError("Target should be aither string or array");

	// result object init
	let res = {};

	// get array of properties need to be converted
	let propS = (typeof source == "string") ? source.replace(/ /g, '').split(",") : source;
	let propT = (typeof target == "string") ? target.replace(/ /g, '').split(",") : target;
 
 	// each property is checked ...
	for (let propertyName in obj) {
		// ... if need be converted or not
		let propIndexInSource = propS.indexOf(propertyName);
		let newName = (propIndexInSource != -1) ? propT[propIndexInSource] : propertyName;

		// take into account that property could be an array
		if (isRecursive && obj[propertyName] instanceof Array) {
			res[newName] = [];
			for (var i = 0; i < obj[propertyName].length; i++) {
				let mappedItem = map(obj[propertyName][i], source, target, isRecursive)
				res[newName].push(mappedItem);
			}
			continue;
		}

		// take into account that JSON object can have nested objects
		if (isRecursive && ((typeof obj[propertyName]) == "object"))
			res[newName] = map(obj[propertyName], source, target, isRecursive);
		else
			res[newName] = obj[propertyName];
	}

	return res;
}