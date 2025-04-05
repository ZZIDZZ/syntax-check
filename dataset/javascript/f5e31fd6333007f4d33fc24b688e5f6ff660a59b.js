function traverseJson(json, callback) {
  let { translations } = json;

  Object.keys(translations).forEach((namespace) => {
    Object.keys(translations[namespace]).forEach((k) => {
      callback(translations[namespace][k], translations[namespace], k);
    });
  });
}