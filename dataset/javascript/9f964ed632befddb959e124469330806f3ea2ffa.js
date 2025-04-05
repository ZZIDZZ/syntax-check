function shouldLog(testlevel, thresholdLevel) {
  var allowed = logLevelAllowedGranular(testlevel);
  if (allowed) {
    return true;
  }

  return logLevelAllowed(testlevel, thresholdLevel);
}