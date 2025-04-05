function normalizeIso8601TimeZone(value) {
    return value ? value.multiplicationFactor * ((value.hour * 60) + value.minute) : -(new Date().getTimezoneOffset());
  }