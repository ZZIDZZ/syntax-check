public ResourceRepresentation<V> withNamespace(String namespace, String href) {
    if (!rels.containsKey("curies")) {
      rels = rels.put("curies", Rels.collection("curies"));
    }

    final NamespaceManager updatedNamespaceManager =
        namespaceManager.withNamespace(namespace, href);
    return new ResourceRepresentation<>(
        content, links, rels, updatedNamespaceManager, value, resources);
  }