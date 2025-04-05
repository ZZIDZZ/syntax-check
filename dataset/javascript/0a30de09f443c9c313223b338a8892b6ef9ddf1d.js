function processParams(paramsString) {
  var individualParams = paramsString.split("&"),
      resultObject = {};

  individualParams.forEach(function(item) {
    var itemParts = item.split("="),
        paramName = itemParts[0],
        paramValue = decodeURIComponent(itemParts[1] || "");

    var paramObject = {};
    paramObject[paramName] = paramValue;

    $.extend(resultObject, paramObject);
  });

  return resultObject;
}