function changed (done) {
  const files = [].slice.call(arguments);
  if (typeof files[files.length - 1] === 'function') done = files.pop();
  done = typeof done === 'function' ? done : () => {};
  debug('Notifying %d servers - Files: ', servers.length, files);
  servers.forEach(srv => {
    const params = { params: { files: files } };
    srv && srv.changed(params);
  });
  done();
}