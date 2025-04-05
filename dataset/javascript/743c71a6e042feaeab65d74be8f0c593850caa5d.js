function emptyRepresentation(value, type) {
  type = type || getType(value);

  switch (type) {
    case 'function':
      return '[Function]';
    case 'object':
      return '{}';
    case 'array':
      return '[]';
    default:
      return value.toString();
  }
}