function getFilename(name) {
		var hash = name.indexOf('#');
		var bang = name.indexOf('!');

		return name.slice(hash < bang ? (hash + 1) : 0, bang);
	}