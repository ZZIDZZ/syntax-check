private ClassLoader createPluginClassLoader() throws CliExecutionException {
        ClassLoader parentClassLoader = Task.class.getClassLoader();
        File homeDirectory = getHomeDirectory();
        if (homeDirectory != null) {
            File pluginDirectory = new File(homeDirectory, DIRECTORY_PLUGINS);
            if (pluginDirectory.exists()) {
                final List<URL> urls = new ArrayList<>();
                final Path pluginDirectoryPath = pluginDirectory.toPath();
                SimpleFileVisitor<Path> visitor = new SimpleFileVisitor<Path>() {

                    @Override
                    public FileVisitResult visitFile(Path file, BasicFileAttributes attrs) throws IOException {
                        if (file.toFile().getName().endsWith(".jar")) {
                            urls.add(file.toFile().toURI().toURL());
                        }
                        return FileVisitResult.CONTINUE;
                    }
                };
                try {
                    Files.walkFileTree(pluginDirectoryPath, visitor);
                } catch (IOException e) {
                    throw new CliExecutionException("Cannot read plugin directory.", e);
                }
                LOGGER.debug("Using plugin URLs: " + urls);
                return new com.buschmais.jqassistant.commandline.PluginClassLoader(urls, parentClassLoader);
            }
        }
        return parentClassLoader;
    }