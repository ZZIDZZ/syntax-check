function KeystoneClient(url, options) {
  options = options || {};

  if (options.username) {
    if (!options.password && !options.apiKey) {
      throw new Error('If username is provided you also need to provide password or apiKey');
    }
  }

  this._url = url;
  this._username = options.username;
  this._apiKey = options.apiKey;
  this._password = options.password;
  this._extraArgs = options.extraArgs || {};
  this._cacheTokenFor = options.cacheTokenFor || DEFAULT_CACHE_TOKEN_FOR;

  this._token = null;
  this._tokenExpires = null;
  this._refreshTokenCompletions = [];
  this._tokenUpdated = 0;
  this._tenantId = null;
  this._serviceCatalog = [];
}