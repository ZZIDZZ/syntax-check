function (roles) {
    if (!Array.isArray(roles)) {
      roles = [roles];
    }
    this.permissions = _.reduce(this.permissions, function (result, actions, key) {
      if (roles.indexOf(key) === -1) {
        result[key] = actions;
      }
      return result;
    }, {});
    return this;
  }