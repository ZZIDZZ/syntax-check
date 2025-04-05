function Item (key, value, publisher, timestamp) {
  if (!(this instanceof Item)) {
    return new Item(key, value, publisher, timestamp)
  }

  assert(typeof key === 'string', 'Invalid key supplied')
  assert(utils.isValidKey(publisher), 'Invalid publisher nodeID supplied')

  if (timestamp) {
    assert(typeof timestamp === 'number', 'Invalid timestamp supplied')
    assert(Date.now() >= timestamp, 'Timestamp cannot be in the future')
  }

  this.key = key
  this.value = value
  this.publisher = publisher
  this.timestamp = timestamp || Date.now()
}