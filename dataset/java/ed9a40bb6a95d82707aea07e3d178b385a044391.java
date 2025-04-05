Builder urlBuilder(String path) {
    Builder builder =
        baseUrlBuilder().addPathSegment(configuration.getApiPackage())
            .addPathSegment(configuration.getApiVersion()).addPathSegment(path);

    if (configuration.getPathModifier() != DiscoveryApiConfiguration.PathModifier.NONE) {
      builder.addPathSegment(configuration.getPathModifier().getModifier());
    }

    return builder;
  }