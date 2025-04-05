private Collection<Resource> getResourcesForGroup(final String groupName) {
    final WroModelInspector modelInspector = new WroModelInspector(model);
    final Group foundGroup = modelInspector.getGroupByName(groupName);
    if (foundGroup == null) {
      final Element groupElement = allGroupElements.get(groupName);
      if (groupElement == null) {
        throw new WroRuntimeException("Invalid group-ref: " + groupName);
      }
      return parseGroup(groupElement);
    }
    return foundGroup.getResources();
  }