private static void registerShutdownHook(final ChameRIA chameleon) {
        Runtime runtime = Runtime.getRuntime();
        Runnable hook = new Runnable() {

            public void run() {
                try {
                    if (chameleon != null) {
                        chameleon.stop();
                        printStoppedBanner();
                    }
                } catch (BundleException e) {
                    System.err.println("Cannot stop Chameleon correctly : "
                            + e.getMessage());
                } catch (InterruptedException e) {
                    System.err.println("Unexpected Exception : "
                            + e.getMessage());
                    // nothing to do
                }
            }
        };
        runtime.addShutdownHook(new Thread(hook));

    }