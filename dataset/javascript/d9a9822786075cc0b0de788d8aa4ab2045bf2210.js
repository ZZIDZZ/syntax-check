function reduceDirectories() {
  return Array.prototype.slice.call(arguments)
    .map(function (candidate) {
      return path.normalize(candidate);
    })
    .filter(function (candidate) {
      return fs.existsSync(candidate) && fs.statSync(candidate).isDirectory();
    })
    .shift();
}