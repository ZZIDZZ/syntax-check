function (keyParts, hash) {

		for (var i = 0; i < keyParts.length-1; ++i) {
			hash = getValue(keyParts[i], hash);
			if (typeof(hash) === 'undefined') {
				return undefined;
			}
		}

		var lastKeyPartIndex = keyParts.length-1;
		return getValue(keyParts[lastKeyPartIndex], hash)
	}