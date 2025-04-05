protected boolean shouldStart() {
    ServerSocket serverSocket = null;
    try {
      serverSocket = getServerSocketFactory().createServerSocket(
          getPort(), getBacklog(), getInetAddress());

      ServerListener<RemoteAppenderClient> listener =
          createServerListener(serverSocket);

      runner = createServerRunner(listener, getContext().getScheduledExecutorService());
      runner.setContext(getContext());
      return true;
    }
    catch (Exception ex) {
      addError("server startup error: " + ex, ex);
      CloseUtil.closeQuietly(serverSocket);
      return false;
    }
  }