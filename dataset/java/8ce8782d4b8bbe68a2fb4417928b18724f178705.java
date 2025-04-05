protected void onTrigger()
            throws IOException, IllegalArgumentException, IllegalAccessException, FileNotFoundException, IllegalStateException {
        endpoint.trigger();
        eventBus.post(new TriggerEvent(endpoint));
    }