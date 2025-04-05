@SuppressWarnings("unchecked")
    @NotNull
    public final <MODEL> List<ArtifactFactory<MODEL>> getFactories(final Class<MODEL> modelType) {
        final List<ArtifactFactory<MODEL>> list = new ArrayList<ArtifactFactory<MODEL>>();
        if (factories == null) {
            factories = new ArrayList<ArtifactFactory<?>>();
            if (factoryConfigs != null) {
                for (final ArtifactFactoryConfig factoryConfig : factoryConfigs) {
                    factories.add(factoryConfig.getFactory());
                }
            }
        }
        for (final ArtifactFactory<?> factory : factories) {
            if (modelType.isAssignableFrom(factory.getModelType())) {
                list.add((ArtifactFactory<MODEL>) factory);
            }
        }
        return list;
    }