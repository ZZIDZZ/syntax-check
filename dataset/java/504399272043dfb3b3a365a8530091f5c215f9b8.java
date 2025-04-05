public GeocodeRequestBuilder componenets(Map<String, String> components) {
		StringBuffer filters = new StringBuffer();
		for (Iterator<Map.Entry<String, String>> iterator = components
				.entrySet().iterator(); iterator.hasNext();) {
			Map.Entry<String, String> entry = iterator.next();
			filters.append(entry.getKey() + ":" + entry.getValue() != null ? entry
					.getValue().replace(' ', '+') : entry.getValue());
			if (iterator.hasNext())
				filters.append("|");
		}
		parameters.put("components", filters.toString());
		return this;
	}