function byteCount(testName, len, baseLen) {
  console.log(testName + " Byte Count: " + len + (baseLen ? ', ' + Math.round(len / baseLen * 100) + '%' : ''));
}