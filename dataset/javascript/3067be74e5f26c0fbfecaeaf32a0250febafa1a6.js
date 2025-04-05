function Worker(queues, options) {
    options || (options = {});

    this.empty = 0;
    this.queues = queues || [];
    this.interval = options.interval || 5000;

    this.callbacks = options.callbacks || {};
    this.strategies = options.strategies || {};
    this.universal = options.universal || false;

    // Default retry strategies
    this.strategies.linear || (this.strategies.linear = linear);
    this.strategies.exponential || (this.strategies.exponential = exponential);

    // This worker will only process jobs of this priority or higher
    this.minPriority = options.minPriority;

}