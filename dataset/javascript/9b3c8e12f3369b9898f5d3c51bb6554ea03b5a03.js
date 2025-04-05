function handleError (err, cb) {
  if (err) {
    if (cb) {
      return process.nextTick(function(){
        cb(err);
      });
    }
    console.error(err);
  }
}