function mktmpdir(prefixSuffix, tmpdir, callback, onend) {
  if ('function' == typeof prefixSuffix) {
    onend = tmpdir;
    callback = prefixSuffix;
    tmpdir = null;
    prefixSuffix = null;
  } else if ('function' == typeof tmpdir) {
    onend = callback;
    callback = tmpdir;
    tmpdir = null;
  }

  prefixSuffix = prefixSuffix || 'd';
  onend = onend || function() {};

  tmpname.create(prefixSuffix, tmpdir, function(err, path, next) {
    if (err) return callback(err);

    fs.mkdir(path, 0700, next);
  }, function(err, path) {
    if (err) return callback(err);

    callback(null, path, function(err) {
      if (!path) return onend(err);

      rimraf(path, function(_err) {
        onend(err || _err, path);
      });
    });
  });
}