public void fireEvent(Object event) {
        if (event == null) {
            throw new IllegalArgumentException("Event must not be null.");
        }
        mTaskQueue.offer(Task.obtainTask(Task.CODE_FIRE_EVENT, event, -1));
        if (!mQueueProcessed) processTaskQueue();
    }