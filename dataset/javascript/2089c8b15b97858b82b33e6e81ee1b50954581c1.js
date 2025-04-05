function isValidMarker(editor, marker) {
	const range = marker.find();

	// No newlines inside abbreviation
	if (range.from.line !== range.to.line) {
		return false;
	}

	// Make sure marker contains valid abbreviation
	let text = editor.getRange(range.from, range.to);
	if (!text || /^\s|\s$/g.test(text)) {
		return false;
	}

	if (marker.model && marker.model.config.syntax === 'jsx' && text[0] === '<') {
		text = text.slice(1);
	}

	if (!marker.model || marker.model.abbreviation !== text) {
		// marker contents was updated, re-parse abbreviation
		try {
			marker.model = new Abbreviation(text, range, marker.model.config);
			if (!marker.model.valid(editor, true)) {
				marker.model = null;
			}
		} catch (err) {
			console.warn(err);
			marker.model = null;
		}
	}

	return Boolean(marker.model && marker.model.snippet);
}