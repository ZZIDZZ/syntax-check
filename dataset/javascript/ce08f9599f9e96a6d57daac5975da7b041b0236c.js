function validate (resource, doc, doValidate) {
  return new Promise((resolve, reject) => {
    if (doValidate !== true) {
      return resolve();
    }
    if (resource.validate(doc)) {
      return resolve();
    } else {
      debug('model have %d error(s)', resource.validate.errors.length);
      return reject(resource.validate.errors);
    }
  });
}