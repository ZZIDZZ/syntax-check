function propertyNameToAttribute(name) {
  var result = name.replace(/([A-Z])/g, function (match, letter) {
    return '-' + letter.toLowerCase();
  });
  return 'data-' + result;
}