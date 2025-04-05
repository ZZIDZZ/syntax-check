function createItemString(data, limit) {
  var count = 0;
  var hasMore = false;
  if ((0, _isSafeInteger2['default'])(data.size)) {
    count = data.size;
  } else {
    for (var _iterator = data, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : (0, _getIterator3['default'])(_iterator);;) {
      var _ref;

      if (_isArray) {
        if (_i >= _iterator.length) break;
        _ref = _iterator[_i++];
      } else {
        _i = _iterator.next();
        if (_i.done) break;
        _ref = _i.value;
      }

      var entry = _ref;
      // eslint-disable-line no-unused-vars
      if (limit && count + 1 > limit) {
        hasMore = true;
        break;
      }
      count += 1;
    }
  }
  return '' + (hasMore ? '>' : '') + count + ' ' + (count !== 1 ? 'entries' : 'entry');
}