public CacheValue newInstance(CacheDirectory directory, String fileName) {
    return newInstance(directory, fileName, getCacheBlockSize(directory, fileName));
  }