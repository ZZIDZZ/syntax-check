function BaseProducer (client, options, defaultPartitionerType, customPartitioner) {
  EventEmitter.call(this);
  options = options || {};

  this.ready = false;
  this.client = client;

  this.requireAcks = options.requireAcks === undefined ? DEFAULTS.requireAcks : options.requireAcks;
  this.ackTimeoutMs = options.ackTimeoutMs === undefined ? DEFAULTS.ackTimeoutMs : options.ackTimeoutMs;

  if (customPartitioner !== undefined && options.partitionerType !== PARTITIONER_TYPES.custom) {
    throw new Error('Partitioner Type must be custom if providing a customPartitioner.');
  } else if (customPartitioner === undefined && options.partitionerType === PARTITIONER_TYPES.custom) {
    throw new Error('No customer partitioner defined');
  }

  var partitionerType = PARTITIONER_MAP[options.partitionerType] || PARTITIONER_MAP[defaultPartitionerType];

  // eslint-disable-next-line
  this.partitioner = new partitionerType(customPartitioner);

  this.connect();
}