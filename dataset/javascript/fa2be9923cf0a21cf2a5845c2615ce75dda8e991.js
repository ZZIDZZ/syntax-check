function (valueToSet, type, iface, propertyKeys) {
    type = type.toLowerCase();
    propertyKeys.forEach(function(propertyKey) {
      if(type == 'get')
        valueToSet['Get'+propertyKey] = function (callback) {
          iface.getProperty(propertyKey, callback);
        }
      else
        valueToSet['Set'+propertyKey] = function (value, callback) {
          iface.setProperty(propertyKey, value, callback);
        }
    });
}