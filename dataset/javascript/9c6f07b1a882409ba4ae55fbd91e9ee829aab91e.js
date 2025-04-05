function (browserify, name, source) {
  if (utility.isNullOrUndefined(browserify)) {
    throw 'browserify must be defined.';
  }

  if (!utility.isNonEmptyString(name)) {
    throw 'name must be defined.';
  }

  if (utility.isNullOrUndefined(source)) {
    throw 'source must be defined.';
  }

  this._browserify = browserify;
  this._name = name;
  this._source = source;
  this._hasModule = false;
  this._hasResolver = false;
}