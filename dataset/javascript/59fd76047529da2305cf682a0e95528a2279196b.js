function arrIncludes (arr, values) {
  if (!Array.isArray(values)) { return inArray(arr, values) }
  var len = values.length;
  var i = -1;

  while (i++ < len) {
    var j = inArray(arr, values[i]);
    if (j) {
      return j
    }
  }

  return false
}