function getApiKey () {
  if (isLocal() && pkg.apiKey) {
    log.trace('using apiKey in fhconfig');
    return pkg.apiKey;
  } else {
    log.trace('using api key in FH_APP_API_KEY env var');
    return env('FH_APP_API_KEY').asString();
  }
}