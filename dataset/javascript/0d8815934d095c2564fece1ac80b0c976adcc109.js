function log(req, res, next) {
  console.log('['
      + chalk.grey(ts())
      + '] '
      + chalk.white(decodeURI(req.url))
  );
  next();
}