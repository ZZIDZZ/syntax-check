function createPasswordHash(object) {
    if (!object) return object;
    var password = object.password;
    if (password) {
      delete object.password;
      object.passwordSalt = sha1(Math.random().toString());
      object.passwordHash = sha1("restify-magic" + object.passwordSalt + password);
    }
    return object;
  }