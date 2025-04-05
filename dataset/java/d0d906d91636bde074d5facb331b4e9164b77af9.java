protected void enqueue(MethodCall<?> methodCall) {
        if (!running.get()) {
            throw new IllegalStateException("Cannot write to a closed service client");
        }

        if (!pendingCalls.offer(methodCall)) {
            // This should never happen with an unbounded queue
            throw new IllegalStateException("Call queue is full");
        }
    }