protected void notifyAttemptToReconnectIn(int seconds) {
        if (isReconnectionAllowed()) {
            for (ConnectionListener listener : connection.connectionListeners) {
                listener.reconnectingIn(seconds);
            }
        }
    }