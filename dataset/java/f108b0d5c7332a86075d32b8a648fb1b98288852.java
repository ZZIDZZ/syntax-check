public <T extends Closeable> T connect(
      String host, int portNumber, Properties props, int loginTimeout) throws IOException {
    @SuppressWarnings("unchecked")
    T socket =
        (T)
            CoreSocketFactory.getInstance()
                .connect(props, CoreSocketFactory.MYSQL_SOCKET_FILE_FORMAT);
    return socket;
  }