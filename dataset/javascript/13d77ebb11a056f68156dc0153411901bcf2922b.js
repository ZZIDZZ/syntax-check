function json(file) {
  var filename = path.basename(file.path, path.extname(file.path)) + ".json";
  return optional(path.join(path.dirname(file.path), filename)) || {};
}