function RequestFunnel() {
  // We use an object here for O(1) lookups (speed).
  this.methods = {
    eth_call: true,
    eth_getStorageAt: true,
    eth_sendTransaction: true,
    eth_sendRawTransaction: true,

    // Ensure block filter and filter changes are process one at a time
    // as well so filter requests that come in after a transaction get
    // processed once that transaction has finished processing.
    eth_newBlockFilter: true,
    eth_getFilterChanges: true,
    eth_getFilterLogs: true
  };
  this.queue = [];
  this.isWorking = false;
}