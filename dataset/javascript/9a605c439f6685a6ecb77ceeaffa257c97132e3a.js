function parseParameters(options) {
  var opt = {
    maximumAge: 0,
    enableHighAccuracy: true,
    timeout: Infinity,
    interval: 6000,
    fastInterval: 1000,
    priority: PRIORITY_HIGH_ACCURACY
  };

  if (options) {
    if (options.maximumAge !== undefined && !isNaN(options.maximumAge) && options.maximumAge > 0) {
      opt.maximumAge = options.maximumAge;
    }
    if (options.enableHighAccuracy !== undefined) {
      opt.enableHighAccuracy = options.enableHighAccuracy;
    }
    if (options.timeout !== undefined && !isNaN(options.timeout)) {
      if (options.timeout < 0) {
        opt.timeout = 0;
      } else {
        opt.timeout = options.timeout;
      }
    }
    if (options.interval !== undefined && !isNaN(options.interval) && options.interval > 0) {
      opt.interval = options.interval;
    }
    if (options.fastInterval !== undefined && !isNaN(options.fastInterval) && options.fastInterval > 0) {
      opt.fastInterval = options.fastInterval;
    }
    if (options.priority !== undefined && !isNaN(options.priority) && options.priority >= PRIORITY_NO_POWER && options.priority <= PRIORITY_HIGH_ACCURACY) {
      if (options.priority === PRIORITY_NO_POWER) {
        opt.priority = PRIORITY_NO_POWER;
      }
      if (options.priority === PRIORITY_LOW_POWER) {
        opt.priority = PRIORITY_LOW_POWER;
      }
      if (options.priority === PRIORITY_BALANCED_POWER_ACCURACY) {
        opt.priority = PRIORITY_BALANCED_POWER_ACCURACY;
      }
      if (options.priority === PRIORITY_HIGH_ACCURACY) {
        opt.priority = PRIORITY_HIGH_ACCURACY;
      }
    }
  }

  return opt;
}