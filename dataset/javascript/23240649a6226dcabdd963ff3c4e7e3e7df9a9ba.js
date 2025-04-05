function setAppConsts() {
  var mergedConstants = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : (0, _seamlessImmutable2.default)(appConsts);

  // set node app consts
  if (typeof self === 'undefined' && typeof global !== 'undefined') {
    global.appConsts = global.appConsts ? _seamlessImmutable2.default.merge(global.appConsts, mergedConstants) : mergedConstants;

    return global.appConsts;
  } else if (typeof self !== 'undefined') {
    // set main & worker threads
    self.appConsts = self.appConsts ? _seamlessImmutable2.default.merge(self.appConsts, mergedConstants) : mergedConstants;

    return self.appConsts;
  }

  return {};
}