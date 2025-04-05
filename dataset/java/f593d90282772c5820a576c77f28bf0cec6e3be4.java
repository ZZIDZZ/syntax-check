@Override
	public ScanResult<String> scan(String cursor, ScanParams params) {
		// We need to extract the MATCH argument from the scan params
		Collection<byte[]> rawParams = params.getParams();
		
		// Raw collection is a list of byte[], made of: key1, value1, key2, value2, etc.
		boolean isKey = true;
		String match = null;
		boolean foundMatchKey = false;
		
		// So, we run over the list, where any even index is a key, and the following data is its value.
		for (byte[] raw : rawParams) {
			if (isKey) {
				String key = new String(raw);
				if (key.equals(new String(MATCH.raw))) {
					// What really interests us is the MATCH key.
					foundMatchKey = true;
				}
			}
			// As soon as we've found the MATCH key, we can stop searching.
			else if (foundMatchKey) {
				match = new String(raw);
				break;
			}
			isKey = !isKey;
		}

		// Our simple implementation of SCAN is really a plain wrapper for KEYS,
		// relying on the current mock implementation of the pattern search.
		return new ScanResult<String>("0", new ArrayList<String>(keys(match)));
	}