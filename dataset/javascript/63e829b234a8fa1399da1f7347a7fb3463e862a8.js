function getRobotsFile (options, callback) {
  fs.readFile(options.source, function (err, data) {
    if (!err) {
      data.toString().split('\n').every(function (line) {
        // Process the line input, but break if base.input returns false.
        // For now, this can only happen if no outputDir is defined,
        //   which is a fatal bad option problem and will happen immediately.
        if (!oneline(line, options)) {
          err = common.prependMsgToErr(base.generatorError(), line, true);
          return false;
        }
        return true;
      });
    }

    callback(err);
  });
}