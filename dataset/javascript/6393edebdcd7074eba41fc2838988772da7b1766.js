function registerDir(leaf, dir, name) {
  var files;
  try {
    files = fs.readdirSync(dir);
  } catch (_error) {}
  if (files == null) {
    return false;
  }
  if (name != null) {
    leaf = subRegister(leaf, name);
  }
  for (var i = 0, len = files.length; i < len; i++) {
    name = files[i];
    leaf.register(dir, name);
  }
  return true;
}