public static Constructor<?>[] getAnnotatedDeclaredConstructors(
			Class<?> clazz, Class<? extends Annotation> annotationClass,
			boolean recursively) {
		Constructor<?>[] allConstructors = getDeclaredConstructors(clazz,
				recursively);
		List<Constructor<?>> annotatedConstructors = new LinkedList<Constructor<?>>();

		for (Constructor<?> field : allConstructors) {
			if (field.isAnnotationPresent(annotationClass))
				annotatedConstructors.add(field);
		}

		return annotatedConstructors
				.toArray(new Constructor<?>[annotatedConstructors.size()]);
	}