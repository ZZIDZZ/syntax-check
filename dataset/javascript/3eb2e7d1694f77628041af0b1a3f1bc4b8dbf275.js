async function thenify(fn) {
  return await new Promise(function(resolve, reject) {
    function callback(err, res) {
      if (err) return reject(err);
      return resolve(res);
    }

    fn(callback);
  });
}