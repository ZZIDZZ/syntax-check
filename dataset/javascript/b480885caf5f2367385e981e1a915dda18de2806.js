function empty(value) {
  if (!value) return true;
  switch (is(value)) {
    case "object": return !Object.keys(value).length;
    case "array": return !value.length;
    default: return !value;
  }
}