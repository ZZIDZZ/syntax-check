function parseVersion(versionString) {
		if (typeof versionString !== 'string') {
			return null;
		}

		var versionRegexMatch = versionString.match(/v?(\d+)\.(\d+)\.(\d+)/i);
		if (versionRegexMatch) {
			return [parseInt(versionRegexMatch[1]), parseInt(versionRegexMatch[2]), parseInt(versionRegexMatch[3])];
		} else {
			return null;
		}
	}