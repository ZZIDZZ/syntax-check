function mkdirp(dir, made) {
  var mode = 0777 & (~process.umask());
  if (!made) made = null;

  dir = path.resolve(dir);

  try {
    fs.mkdirSync(dir, mode);
    made = made || dir;
  } catch (err0) {
    switch (err0.code) {
      case 'ENOENT':
        made = mkdirp(path.dirname(dir), made);
        mkdirp(dir, made);
        break;
      default:
        var stat;
        try {
          stat = fs.statSync(dir);
        } catch (err1) {
          throw err0;
        }
        if (!stat.isDirectory()) throw err0;
        break;
    }
  }

  return made;
}