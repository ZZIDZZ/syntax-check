function _defaultCheckSize(size) {
  return function (raw) {
    if (raw.length < size) {
      return false;
    }
    this.buffer = raw.substr(size);
    return raw.substr(0, size);
  };
}