function devToolsMiddleware(debuggerProxy) {
  return (req, res, next) => {
    switch (req.cleanPath) {
      /**
       * Request for the debugger frontend
       */
      case '/debugger-ui/':
      case '/debugger-ui': {
        const readStream = fs.createReadStream(
          path.join(__dirname, '../assets/debugger.html')
        );
        res.writeHead(200, { 'Content-Type': 'text/html' });
        readStream.pipe(res);
        break;
      }

      /**
       * Request for the debugger worker
       */
      case '/debugger-ui/debuggerWorker.js':
      case '/debuggerWorker.js': {
        const readStream = fs.createReadStream(
          path.join(__dirname, '../assets/debuggerWorker.js')
        );
        res.writeHead(200, { 'Content-Type': 'application/javascript' });
        readStream.pipe(res);
        break;
      }

      /**
       * Request for (maybe) launching devtools
       */
      case '/launch-js-devtools': {
        if (!debuggerProxy.isDebuggerConnected()) {
          launchBrowser(`http://localhost:${req.socket.localPort}/debugger-ui`);
        }
        res.end('OK');
        break;
      }

      default:
        next();
    }
  };
}