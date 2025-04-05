function command_exists (paths, name) {

	if (is.string(paths)) {
		paths = paths.split(':');
	}

	debug.assert(paths).is('array');

	return paths.some(dir => fs.existsSync(PATH.join(dir, name)));
}