synchronized public V get(K key) {
        final Pair<V, Long> cachePair = lruCache.get(key);
        if (cachePair != null && cachePair.first != null) {
            if (cachePair.second > System.currentTimeMillis()) {
                return cachePair.first;
            } else {
                lruCache.remove(key);
            }
        }
        return null;
    }