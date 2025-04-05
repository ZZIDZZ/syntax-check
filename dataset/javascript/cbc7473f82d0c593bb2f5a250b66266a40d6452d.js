function isEmptyDirectory(path) {
  var files;
  try {
    files = fs.readdirSync(path);
    if(files.length > 0) {
      return false;
    }
  } catch(err) {
    if(err.code) {
      terminal.abort('Error: ', err);
    } else {
      throw e;
    }
  }
  return true;
}