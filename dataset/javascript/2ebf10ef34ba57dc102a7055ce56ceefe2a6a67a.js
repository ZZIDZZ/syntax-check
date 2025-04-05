function get_data (callback) {
  var data;
  try {
    data = program.data ? JSON.parse(program.data) : {};
    callback(data);
  } catch (err) {
    fs.readFile(program.data, function (err, str) {
      str = '' + str;
      if (!err) {
        try {
          data = JSON.parse(str);
          callback(data);
        } catch (err) {
          data = eval(str);
          callback(data);
        }
      }
    });
  }
  return data;
}