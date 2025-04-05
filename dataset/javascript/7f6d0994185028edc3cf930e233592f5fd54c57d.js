function supportsCodeConstraint(identifier, dataElementSpecs) {
  if (CODE.equals(identifier) || checkHasBaseType(identifier, new Identifier('shr.core', 'Coding'), dataElementSpecs)
      || checkHasBaseType(identifier, new Identifier('shr.core', 'CodeableConcept'), dataElementSpecs)) {
    return true;
  }
  const element = dataElementSpecs.findByIdentifier(identifier);
  if (element.value) {
    if (element.value instanceof IdentifiableValue) {
      return CODE.equals(element.value.identifier) || checkHasBaseType(element.value.identifier, new Identifier('shr.core', 'Coding'), dataElementSpecs)
          || checkHasBaseType(element.value.identifier, new Identifier('shr.core', 'CodeableConcept'), dataElementSpecs);
    } else if (element.value instanceof ChoiceValue) {
      for (const value of element.value.aggregateOptions) {
        if (value instanceof IdentifiableValue) {
          if (CODE.equals(value.identifier) || checkHasBaseType(value.identifier, new Identifier('shr.core', 'Coding'), dataElementSpecs)
              || checkHasBaseType(value.identifier, new Identifier('shr.core', 'CodeableConcept'), dataElementSpecs)) {
            return true;
          }
        }
      }
    }
  }
  return false;
}