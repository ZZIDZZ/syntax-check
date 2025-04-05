function normalizeEventHandlerOptions(options, defaultBoolKeys) {
  const returnValue = {};

  // no need to go further here
  if (typeof options === "boolean" || options === null || typeof options === "undefined") {
    returnValue.capture = Boolean(options);
    return returnValue;
  }

  // non objects options so we typecast its value as "capture" value
  if (typeof options !== "object") {
    returnValue.capture = Boolean(options);
    // at this point we don't need to loop the "capture" key anymore
    defaultBoolKeys = defaultBoolKeys.filter(k => k !== "capture");
  }

  for (const key of defaultBoolKeys) {
    returnValue[key] = Boolean(options[key]);
  }

  return returnValue;
}