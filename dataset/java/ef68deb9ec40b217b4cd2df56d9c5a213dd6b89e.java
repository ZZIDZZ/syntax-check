@Override
	public void config(Config config) throws ConfigException, IOException {
		for (Config repositorySection : config.findChildren("repository")) {
			// view manager configuration section is named <views>
			// a <views> configuration section has one or many <repository> child sections
			// scan every repository files accordingly files pattern and add meta views to views meta pool

			// load repository view implementation class and perform insanity checks
			String className = repositorySection.getAttribute("class", DEF_IMPLEMENTATION);
			Class<?> implementation = Classes.forOptionalName(className);
			if (implementation == null) {
				throw new ConfigException("Unable to load view implementation |%s|.", className);
			}
			if (!Types.isKindOf(implementation, View.class)) {
				throw new ConfigException("View implementation |%s| is not of proper type.", className);
			}
			if (!Classes.isInstantiable(implementation)) {
				throw new ConfigException("View implementation |%s| is not instantiable. Ensure is not abstract or interface and have default constructor.", implementation);
			}
			@SuppressWarnings("unchecked")
			Class<? extends View> viewImplementation = (Class<? extends View>) implementation;

			// load repository path and files pattern and create I18N repository instance
			String repositoryPath = repositorySection.getAttribute("path");
			if (repositoryPath == null) {
				throw new ConfigException("Invalid views repository configuration. Missing <path> attribute.");
			}
			String filesPattern = repositorySection.getAttribute("files-pattern");
			if (filesPattern == null) {
				throw new ConfigException("Invalid views repository configuration. Missing <files-pattern> attribute.");
			}

			ConfigBuilder builder = new I18nRepository.ConfigBuilder(repositoryPath, filesPattern);
			I18nRepository repository = new I18nRepository(builder.build());
			if (viewsMetaPool == null) {
				// uses first repository to initialize i18n pool
				// limitation for this solution is that all repositories should be the kind: locale sensitive or not
				viewsMetaPool = repository.getPoolInstance();
			}
			Properties properties = repositorySection.getProperties();

			// traverses all files from I18N repository instance and register view meta instance
			// builder is used by view meta to load the document template
			for (I18nFile template : repository) {
				ViewMeta meta = new ViewMeta(template.getFile(), viewImplementation, properties);
				if (viewsMetaPool.put(meta.getName(), meta, template.getLocale())) {
					log.warn("Override view |%s|", meta);
				} else {
					log.debug("Register view |%s|", meta);
				}
			}
		}
	}