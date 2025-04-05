public void setThreadPoolEnabled(boolean value) {
        if (value && (threadPool == null)) {
            threadPool = Executors.newCachedThreadPool();
        }
        threadPoolEnabled = value;
    }