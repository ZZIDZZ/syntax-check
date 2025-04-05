function watcherFn(schemaFilepath, watchInterval, reinitBabelRelayPlugin, prevMtime) {
  try {
    let stats;
    try {
      stats = fs.statSync(schemaFilepath);
    } catch (e) {
      // no problem
    }
    if (stats) {
      if (!prevMtime) prevMtime = stats.mtime;
      if (stats.mtime.getTime() !== prevMtime.getTime()) {
        prevMtime = stats.mtime;
        reinitBabelRelayPlugin();
      }
    }
    setTimeout(
      () => {
        watcherFn(schemaFilepath, watchInterval, reinitBabelRelayPlugin, prevMtime);
      },
      watchInterval
    ).unref(); // fs.watch blocks babel from exit, so using `setTimeout` with `unref`
  } catch (e) {
    log(e);
  }
}