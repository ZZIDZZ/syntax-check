function (obj) {
    const keys = _.sortBy(_.keys(obj), function (key) {
      return key;
    });
    return _.zipObject(keys, _.map(keys, function (key) {
      return obj[key];
    }));
  }