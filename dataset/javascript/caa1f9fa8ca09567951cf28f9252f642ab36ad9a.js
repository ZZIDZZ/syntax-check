function getHash(uri) {
  var hash = parse(uri).hash
  return hash ? hash.slice(1) : null
}