function builder(envList, envName) {
  if (envList == null) {
    envList = DEFAULT_ENV_LIST;
  }
  if (envName == null) {
    envName = DEFAULT_ENV_NAME;
  }
  if (!Array.isArray(envList)) {
    throw new Error('envList must be an array');
  }
  if (typeof envName !== 'string') {
    throw new Error('envName must be a string');
  }

  // .
  const index = envList.indexOf(env.get(envName, DEFAULT_ENV).required().asString());

  /**
   * .
   */
  // return function defaults(obj) {
  //   return 'object' !== typeof obj ? obj : obj[index];
  // };
  let body;
  if (index < 0) {
    body = 'return function defaults() {}';
  } else {
    body = `return function defaults(obj) { return 'object' !== typeof obj ? obj : obj[${index}] }`;
  }
  return new Function(body)();
}