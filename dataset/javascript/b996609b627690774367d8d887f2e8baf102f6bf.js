function cleanup(done) {
  config = null;

  rules.forEach(function(rule){
    rule.done();
  });
  nock.cleanAll();

  handles.server.close();
  if (handles.gatewayServer !== undefined && handles.gatewayServer !== null) {
    handles.gatewayServer.close();
  }

  fs.unlinkSync(path.join(handles.filepath, '/index.txt'));

  handles = null;

  done();
}