function writeRegistry() {
		logger.trace("inside writeRegistry()");
		var filepath = path.join(rootpath, "resolver.js");
		var content = fs.readFileSync(filepath, 'utf8');
		var regex = /(var\s+registry\s+=\s+)[^;]*(;)/g;
		var modified = content.replace(regex, "$1" + JSON.stringify(registry) + "$2");
		fs.writeFileSync(filepath, modified);
	}