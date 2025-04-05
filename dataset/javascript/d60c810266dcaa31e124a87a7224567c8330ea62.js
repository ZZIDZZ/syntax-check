function serialize(bson, options) {
  options = options || {};
  return JSON.parse(stringify(bson, options));
}