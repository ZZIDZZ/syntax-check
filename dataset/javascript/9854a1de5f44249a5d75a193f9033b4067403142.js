function matchExact (myProtocol, senderProtocol, callback) {
  const result = myProtocol === senderProtocol
  callback(null, result)
}