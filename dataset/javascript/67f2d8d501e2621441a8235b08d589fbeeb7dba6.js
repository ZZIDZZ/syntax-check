function checkBinReferences_ (file, data, warn, cb) {
  if (!(data.bin instanceof Object)) return cb()

  var keys = Object.keys(data.bin)
  var keysLeft = keys.length
  if (!keysLeft) return cb()

  function handleExists (relName, result) {
    keysLeft--
    if (!result) warn('No bin file found at ' + relName)
    if (!keysLeft) cb()
  }

  keys.forEach(function (key) {
    var dirName = path.dirname(file)
    var relName = data.bin[key]
    try {
      var binPath = path.resolve(dirName, relName)
      fs.stat(binPath, (err) => handleExists(relName, !err))
    } catch (error) {
      if (error.message === 'Arguments to path.resolve must be strings' || error.message.indexOf('Path must be a string') === 0) {
        warn('Bin filename for ' + key + ' is not a string: ' + util.inspect(relName))
        handleExists(relName, true)
      } else {
        cb(error)
      }
    }
  })
}