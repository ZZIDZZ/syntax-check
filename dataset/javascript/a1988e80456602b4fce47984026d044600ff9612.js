function PokitDok(clientId, clientSecret, version) {
    this.clientId = clientId;
    this.clientSecret = clientSecret;
    this.version = version || 'v4';
    this.refreshActive = false;
    this.retryQueue = [];
    this.accessToken = null;
}