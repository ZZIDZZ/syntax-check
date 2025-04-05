private RedisSession getSession(String id, boolean allowExpired) {
		Map<Object, Object> entries = getSessionBoundHashOperations(id).entries();
		if (entries.isEmpty()) {
			return null;
		}
		MapSession loaded = loadSession(id, entries);
		if (!allowExpired && loaded.isExpired()) {
			return null;
		}
		RedisSession result = new RedisSession(loaded);
		result.originalLastAccessTime = loaded.getLastAccessedTime();
		return result;
	}