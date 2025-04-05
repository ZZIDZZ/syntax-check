function wrapCallback(original) {
  var length = listeners.length;

  // no context to capture, so avoid closure creation
  if (length === 0) return original;

  // capture the active listeners as of when the wrapped function was called
  var list = listeners.slice();

  for (var i = 0; i < length; ++i) {
    if (list[i].flags > 0) return asyncWrap(original, list, length);
  }

  return simpleWrap(original, list, length);
}