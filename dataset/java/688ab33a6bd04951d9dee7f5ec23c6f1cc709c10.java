public void start() throws Exception {
        log.info("Robot Framework remote server starting");
        server.start();
        log.info(String.format("Robot Framework remote server started on port %d.", getLocalPort()));
    }