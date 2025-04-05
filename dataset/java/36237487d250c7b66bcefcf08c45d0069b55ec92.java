public static <T> Constructor<T> commonConstructor(Class<T> type)
			throws NoMethodForDependency {
		Constructor<?>[] cs = type.getDeclaredConstructors();
		if (cs.length == 0)
			throw new NoMethodForDependency(raw(type));
		Constructor<?> mostParamsConstructor = null;
		for (Constructor<?> c : cs) {
			if (!arrayContains(c.getParameterTypes(), type, (a, b) -> a == b) // avoid self referencing constructors (synthetic) as they cause endless loop
				&& (mostParamsConstructor == null //
					|| (moreVisible(c, mostParamsConstructor) == c
						&& (moreVisible(mostParamsConstructor, c) == c
							|| c.getParameterCount() > mostParamsConstructor.getParameterCount())))) {
				mostParamsConstructor = c;
			}
		}
		if (mostParamsConstructor == null)
			throw new NoMethodForDependency(raw(type));
		@SuppressWarnings("unchecked")
		Constructor<T> c = (Constructor<T>) mostParamsConstructor;
		return c;
	}