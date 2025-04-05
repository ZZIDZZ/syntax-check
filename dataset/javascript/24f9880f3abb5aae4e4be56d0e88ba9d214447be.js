function fetch(repoState, driver, sha) {
    if (isFetched(repoState, sha)) {
        // No op if already fetched
        return Q(repoState);
    }

    const cache = repoState.getCache();
    // Fetch the blob
    return driver.fetchBlob(sha)
    // Then store it in the cache
    .then((blob) => {
        const newCache = CacheUtils.addBlob(cache, sha, blob);
        return repoState.set('cache', newCache);
    });
}