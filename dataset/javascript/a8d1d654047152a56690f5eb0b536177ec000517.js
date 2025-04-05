function gulpStaticI18n(options) {
  return through.obj(function(target, encoding, cb) {
    var stream = this;
    var build = new StaticI18n(target, options, stream);
    build.translate(cb);
  });
}