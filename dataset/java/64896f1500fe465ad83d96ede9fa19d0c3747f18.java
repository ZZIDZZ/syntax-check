public boolean runIfNotCancelled() {
        final AtomicInteger stateRef = this.stateRef;
        int oldVal;
        do {
            oldVal = stateRef.get();
            if (oldVal == ST_CANCELLED || oldVal == ST_CANCELLED_FLAG_SET) {
                return false;
            } else if (oldVal != ST_WAITING) {
                throw Assert.unreachableCode();
            }
        } while (! stateRef.compareAndSet(oldVal, ST_STARTED));
        return true;
    }