function checkPattern(file, blackList, whiteList){

  if (util.isRegExp(blackList) && blackList.test(file)) {
    return false;
  }

  if (util.isRegExp(whiteList)) {
    if (whiteList.test(file)) {
      return true;
    }
    return false;
  }

  return true;
}