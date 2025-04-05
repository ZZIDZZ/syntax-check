protected Object session(Type type, String name) {
		return parameter(type, name, new Function<String, Object>() {

			public Object apply(String name) {
				return context.session().getAttribute(name);
			}
			
		}, new Function<String, Collection<Object>>() {

			@SuppressWarnings("unchecked")
			public Collection<Object> apply(String name) {
				HttpSession session = context.session();
				Object attribute = session.getAttribute(name);
				
				if (attribute instanceof Collection<?>) {
					return (Collection<Object>) attribute;
				}
				
				Map<String, Object> map = new TreeMap<String, Object>();
				
				for (Object object : Collections.list(session.getAttributeNames())) {
					String key = (String) object;
					
					if (key.startsWith(name + "[")) {
						map.put(key, session.getAttribute(key));
					}
				}
				
				return (map.isEmpty()) ? null : map.values();
			}
			
		});
	}