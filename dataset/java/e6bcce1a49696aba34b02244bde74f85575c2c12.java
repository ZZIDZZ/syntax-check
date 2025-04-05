@SuppressWarnings("unchecked")
	private static Collection<Class<? extends Plugin>> scanPlugins() {
		ClassPathScanningCandidateComponentProvider componentProvider = new ClassPathScanningCandidateComponentProvider(false);
		componentProvider.addIncludeFilter(new AssignableTypeFilter(Plugin.class));

		return componentProvider.findCandidateComponents("org.elasticsearch.plugin").stream()
				.map(BeanDefinition::getBeanClassName)
				.map(name -> {
					try {
						return (Class<? extends Plugin>) Class.forName(name);
					} catch (ClassNotFoundException e) {
						logger.warn("Cannot load class on plugin detection", e);
						return null;
					}
				})
				.collect(Collectors.toSet());
	}