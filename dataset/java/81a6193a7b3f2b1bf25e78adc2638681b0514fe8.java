public long calculateDelay(TimeUnit unit) {
    float delta = variancePercent / 100f; // e.g., 20 / 100f == 0.2f
    float lowerBound = 1f - delta; // 0.2f --> 0.8f
    float upperBound = 1f + delta; // 0.2f --> 1.2f
    float bound = upperBound - lowerBound; // 1.2f - 0.8f == 0.4f
    float delayPercent = lowerBound + (random.nextFloat() * bound); // 0.8 + (rnd * 0.4)
    long callDelayMs = (long) (delayMs * delayPercent);
    return MILLISECONDS.convert(callDelayMs, unit);
  }