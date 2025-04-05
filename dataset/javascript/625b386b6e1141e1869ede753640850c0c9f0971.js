function find(filter) {
  var item;
  var i;
  var ilen;
  var keys;
  var key;
  var k;
  var klen;
  var found;

  if (filter instanceof Function) {
    for (i = 0, ilen = this.items.length; i < ilen; ++i) {
      item = this.items[i];
      if (filter(item, i)) {
        return item;
      }
    }
  } else if (filter !== null && filter !== undefined) {
    if (typeof filter === 'object') {
      keys = Object.keys(filter);
      klen = keys.length;
      for (i = 0, ilen = this.items.length; i < ilen; ++i) {
        item = this.items[i];
        found = true;
        for (k = 0; k < klen && found; ++k) {
          key = keys[k];
          if (filter[key] !== item[key]) {
            found = false;
          }
        }
        if (found) {
          return item;
        }
      }
    } else if (this.modelType) {
      keys = Object.keys(this.modelType.attributes);
      klen = keys.length;
      for (i = 0, ilen = this.items.length; i < ilen; ++i) {
        item = this.items[i];
        found = false;
        for (k = 0; k < klen && !found; ++k) {
          key = keys[k];
          if (filter === item[key]) {
            found = true;
          }
        }
        if (found) {
          return item;
        }
      }
    } else {
      for (i = 0, ilen = this.items.length; i < ilen; ++i) {
        item = this.items[i];
        found = false;
        keys = Object.keys(item);
        for (k = 0, klen = keys.length; k < klen && !found; ++k) {
          key = keys[k];
          if (filter === item[key]) {
            found = true;
          }
        }
        if (found) {
          return item;
        }
      }
    }
  }

  return undefined;
}