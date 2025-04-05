function clone (obj) {
  var newObj = {};

  // Return a new obj if no `obj` passed in
  if (!obj || typeof obj !== 'object' || Array.isArray(obj))
    return newObj;

  for (var prop in obj)
    newObj[prop] = obj[prop];
  return newObj;
}