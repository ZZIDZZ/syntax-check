function clone(frm, to) {
	if (frm === null || typeof frm !== "object") {
		return frm;
	}
	if (frm.constructor !== Object && frm.constructor !== Array) {
		return frm;
	}
	if (frm.constructor === Date || frm.constructor === RegExp || frm.constructor === Function ||
		frm.constructor === String || frm.constructor === Number || frm.constructor === Boolean) {
		return new frm.constructor(frm);
	}
	to = to || new frm.constructor();
	for (var name in frm) {
		to[name] = typeof to[name] === "undefined" ? clone(frm[name], null) : to[name];
	}
	return to;
}