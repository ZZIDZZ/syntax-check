function (object) {
  var propList = [];
  var methodList = [];
  for (var k in object) {
    if (typeof object[k] === "function") {
      methodList.push(k);
    } else {
      propList.push(k);
    }
  }
  return {
    propList: propList,
    methodList: methodList,
  };
}