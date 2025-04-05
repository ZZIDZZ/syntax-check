protected static <TYPE> List<TYPE> getList(String path, String key,
			Class<TYPE> expectedClass, List<String> filters) {
		StringBuilder tempPath = new StringBuilder(path);
		tempPath.append("?");

		for (String filter :
				filters) {
			tempPath.append(filter).append('&');
		}

		return getList(tempPath.substring(0, tempPath.length() - 1), key, expectedClass);
	}