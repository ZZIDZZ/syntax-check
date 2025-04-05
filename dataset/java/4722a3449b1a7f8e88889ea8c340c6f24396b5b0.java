private void doCheck() {
        if (!running) return;
        if (fileManager == null) return;
        
        if (unexpectedErrors > MAX_UNEXPECTED_ERRORS) {
            log.info("Terminating because of errors");
            terminate(false);
            return;
        }

        Timer.Context waitTimerContext = waitingTimer.time();
        // Possible infinite thread sleep? This will make sure we fire downloading only when are the files are consumed/merged
        while (downloadDir.listFiles().length != 0) {
            log.debug("Waiting for files in download directory to clear up. Sleeping for 1 min. If you see this persistently, it means the downloaded files are not getting merged properly/timely");
            try { Thread.sleep(60000); } catch (Exception ex) {}
        }
        waitTimerContext.stop();
        if (downloadLock.tryLock()) {
            try {
                if (fileManager.hasNewFiles()) {
                    fileManager.downloadNewFiles(downloadDir);
                }
            } catch (Throwable unexpected) {
                unexpectedErrors += 1;
                log.error("UNEXPECTED; WILL TRY TO RECOVER");
                log.error(unexpected.getMessage(), unexpected);
                // sleep for a minute?
                if (Thread.interrupted()) {
                    try {
                        thread.sleep(60000);
                    } catch (Exception ex) {
                        log.error(ex.getMessage(), ex);
                    }
                }
            } finally {
                downloadLock.unlock();
            }
        } else {
            log.debug("Download in progress");
        }
    }