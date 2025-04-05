function Memory(options) {
  options = options || {};
  var self = this;
  self.flush = options.db._db._memory.flush || false;
  self.flushInterval = options.db._db._memory.flushInterval || 10000;
  self.flushFile = options.file;
  self.memoryTable = [];
  console.log('Data will be handled using \'Memory\' driver');
  // :S yeah we need to load it synchronously otherwise it might be loaded after the first insert
  var content = util.fileSystem.readSync(self.flushFile);
  self.set(content);
  if (self.flush) {
    console.log('\'Memory\' driver will flush data every %sms', self.flushInterval);
    // set interval to flush
    setInterval(function flushToDisk() {
      util.fileSystem.lock(self.flushFile, function afterLock(err) {
        if (err) {
          throw err;
        }
        self.get(function afterGet(err, inMemoryContent) {
          if (err) {
            util.fileSystem.unlock(self.flushFile);
            throw err;
          }
          util.fileSystem.write(self.flushFile, inMemoryContent, function afterWrite(err) {
            util.fileSystem.unlock(self.flushFile);
            if (err) {
              throw err;
            }
          });
        });
      });
    }, self.flushInterval);
  }
}