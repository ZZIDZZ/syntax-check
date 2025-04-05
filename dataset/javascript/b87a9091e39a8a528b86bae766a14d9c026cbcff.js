function handleElements(elements, type, fn, capture) {
  if (!elements || typeof elements.length !== 'number') throw new TypeError('Cannot bind event ' + inspect(type) + ' to ' + inspect(elements));
  if (typeof type !== 'string') throw new TypeError('Event type must be a string, e.g. "click", not ' + inspect(type));
  if (typeof fn !== 'function') throw new TypeError('`fn` (the function to call when the event is triggered) must be a function, not ' + inspect(fn));
  if (capture !== undefined && capture !== false && capture !== true) {
    throw new TypeError('`capture` must be `undefined` (defaults to `false`), `false` or `true`, not ' + inspect(capture));
  }

  var handles = [];
  for (var i = 0; i < elements.length; i++) {
    handles.push(handleElement(elements[i], type, fn, capture));
  }
  return function dispose() {
    for (var i = 0; i < handles.length; i++) {
      handles[i]();
    }
  };
}