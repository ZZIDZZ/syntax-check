function hasSystemLib (lib) {
  var libName = 'lib' + lib + '.+(so|dylib)'
  var libNameRegex = new RegExp(libName)

    // Try using ldconfig on linux systems
  if (hasLdconfig()) {
    try {
      if (childProcess.execSync('ldconfig -p 2>/dev/null | grep -E "' + libName + '"').length) {
        return true
      }
    } catch (err) {
      // noop -- proceed to other search methods
    }
  }

    // Try checking common library locations
  return SYSTEM_PATHS.some(function (systemPath) {
    try {
      var dirListing = fs.readdirSync(systemPath)
      return dirListing.some(function (file) {
        return libNameRegex.test(file)
      })
    } catch (err) {
      return false
    }
  })
}