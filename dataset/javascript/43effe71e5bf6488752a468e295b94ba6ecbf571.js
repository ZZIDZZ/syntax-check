function compileWasm(options) {
  run("python", [
    path.join(emscriptenDirectory, "em++"),
    "shared.bc"
  ].concat(commonOptions).concat([
    "--post-js", options.post,
    "--closure", "1",
    "-s", "EXPORTED_FUNCTIONS=[" + exportedFunctionsArg + "]",
    "-s", "ALLOW_MEMORY_GROWTH=1",
    "-s", "BINARYEN=1",
    "-s", "BINARYEN_METHOD=\"native-wasm\"",
    "-s", "MODULARIZE_INSTANCE=1",
    "-s", "EXPORT_NAME=\"Binaryen\"",
    "-o", options.out,
    "-Oz"
  ]));
}