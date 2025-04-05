function startGc(db, options) {
  this.options = options || {}

  var freqMs = options.gcFreqMs || 60000

  var maxVersions = options.gcMaxVersions
  var maxAge = options.gcMaxAge
  var backup = options.gcBackup
  var callback = options.gcCallback

  if (maxAge || maxVersions) {
    maxAge = maxAge || Math.pow(2, 53)
    maxVersion = maxVersions || Math.pow(2, 53)

    function filter(record) {
      if (record.version != null) {
        if (Date.now() - record.version > maxAge) return true
      }
      if (record.key != this.currentKey) {
        this.currentKey = record.key
        this.currentCount = 0
      }
      return this.currentCount++ >= maxVersions
    }

    this.scanner = gc(db, filter, backup)
    return looseInterval(scanner.run.bind(scanner), freqMs, callback)
  }
}