function packageModule(global, name, api) {
  if (global.define && global.define.amd) {
    define([], api);
  } else if (typeof exports !== "undefined") {
    module.exports = api;
  } else {
    global[name] = api;
  }
}