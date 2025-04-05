function getXml(path, finish) {
  fs.readFile(path, function(err, data) {
      if (err) throw err;
      xmlParser.parseString(data, function (err, result) {
        if (err) throw err;
        finish(result);
      });
  });
}