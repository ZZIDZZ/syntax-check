protected boolean pollIndividually() throws IOException {
        this.concurrencyTestHooks.onStartPollIndividually();

        List<SchedulerProcessExecutionSlip> processExecutionSlipList = new LinkedList<>();
        for (final Object onePolledObject : this.polledObjects) {
            // Stop as soon as possible if shutting down.
            if (shutdownInd) {
                return true;
            }

            SchedulerProcess process = new PollOneObjectSchedulerProcess(onePolledObject);
            SchedulerProcessExecutionSlip executionSlip = this.scheduler.startProcess(process);
            processExecutionSlipList.add(executionSlip);
        }

        for (SchedulerProcessExecutionSlip oneExecutionSlip : processExecutionSlipList) {
            try {
                //
                // Wait for this process to complete
                //
                oneExecutionSlip.waitUntilComplete();


                //
                // Check for a failure
                //
                PollOneObjectSchedulerProcess process =
                        (PollOneObjectSchedulerProcess) oneExecutionSlip.getSchedulerProcess();

                Exception exc = process.getFailureException();
                if (exc != null) {
                    log.warn("failed to poll object", exc);

                    // Propagate IOExceptions since they most likely mean that the connection needs to be recovered.
                    if (exc instanceof IOException) {
                        throw (IOException) exc;
                    }
                }

            } catch (InterruptedException intExc) {
                log.info("interrupted while polling object");
            }
        }

        return false;
    }