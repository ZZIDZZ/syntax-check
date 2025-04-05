function snapshotPreprocessor(basePath, loggerFactory) {
  const logger = loggerFactory.create('preprocessor.snapshot');

  return function (content, file, done) {
    const root = snapshotSerializer.deserialize(content);
    done(iifeWrapper('window.__snapshot__.addSuite("' + root.name + '",' + JSON.stringify(root.suite) + ');'));
  };
}