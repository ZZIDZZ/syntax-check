public void invalidateAll(Predicate<? super JwtContext> predicate) {
        cache.asMap().entrySet().stream()
            .map(entry -> entry.getValue().getKey())
            .filter(predicate::test)
            .map(JwtContext::getJwt)
            .forEach(cache::invalidate);
    }