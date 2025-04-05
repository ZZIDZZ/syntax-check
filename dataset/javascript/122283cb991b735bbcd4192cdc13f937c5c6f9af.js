function mapPrune(input, schema) {
  var result = {};
  _.forOwn(schema, function (value, key) {
    if (_.isPlainObject(value)) {
      // Recursive.
      result[key] = mapPrune(input[key] || {}, value);
    } else {
      // Base. Null is set as the default value.
      result[key] = input[key] || null;
    }
  });
  return result;
}